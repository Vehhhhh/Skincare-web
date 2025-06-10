<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ChatbotController extends Controller
{
    public function sendMessage(Request $request)
    {
        $message = $request->input('message');
        $apiKey = env('OPENAI_API_KEY');

        if (!$apiKey) {
            return response()->json([
                'success' => false,
                'message' => 'OpenAI API key not configured. Please add OPENAI_API_KEY to your .env file.'
            ], 500);
        }

        try {
            // Log the request attempt (without exposing the full API key)
            Log::info('Attempting OpenAI API request', [
                'message_length' => strlen($message),
                'api_key_exists' => !empty($apiKey)
            ]);

            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Content-Type' => 'application/json',
                'OpenAI-Beta' => 'assistants=v1'  // Include this for newer models
            ])->post('https://api.openai.com/v1/chat/completions', [
                'model' => 'gpt-4o',
                'messages' => [
                    [
                        'role' => 'system',
                        'content' => 'You are a friendly and knowledgeable skincare specialist assistant for a skincare e-commerce website called "House of Beauty".

                        Your expertise includes:
                        - Skincare products and their benefits
                        - Ingredients and their effects on different skin types
                        - Personalized skincare routines
                        - Common skin concerns and solutions
                        - Product recommendations based on skin type and concerns
                        - How to use skincare products correctly

                        When answering:
                        - Be concise but informative
                        - Be friendly and approachable
                        - Reference House of Beauty products where appropriate
                        - Don\'t make up specific product names or prices unless explicitly mentioned by the customer
                        - Focus on being helpful rather than sales-oriented
                        - For very specific medical issues, suggest consulting a dermatologist

                        Keep responses under 3-4 sentences for readability in the chat widget.'
                    ],
                    ['role' => 'user', 'content' => $message]
                ],
                'temperature' => 0.7,
                'max_tokens' => 200
            ]);

            // Log the response status
            Log::info('OpenAI API response received', [
                'status' => $response->status(),
                'success' => $response->successful()
            ]);

            if (!$response->successful()) {
                Log::error('OpenAI API error', [
                    'status' => $response->status(),
                    'body' => $response->body()
                ]);

                return response()->json([
                    'success' => false,
                    'message' => 'Error from OpenAI API: ' . $response->body()
                ], 500);
            }

            $responseBody = $response->json();

            if (isset($responseBody['choices'][0]['message']['content'])) {
                return response()->json([
                    'success' => true,
                    'message' => $responseBody['choices'][0]['message']['content']
                ]);
            } else {
                Log::error('Invalid response structure from OpenAI', [
                    'response' => $responseBody
                ]);

                return response()->json([
                    'success' => false,
                    'message' => 'Invalid response from OpenAI API. Check your API key and permissions.'
                ], 500);
            }
        } catch (\Exception $e) {
            Log::error('Exception when calling OpenAI API', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Error connecting to OpenAI API: ' . $e->getMessage()
            ], 500);
        }
    }
}
