<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use App\Services\TwilioService;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Twilio\Exceptions\RestException;


class RegisteredUserController extends Controller
{
    protected $twilioService;

    public function __construct(TwilioService $twilioService)
    {
        $this->twilioService = $twilioService;
    }
    /**
     * Display the registration view.
     */
    public function index(Request $request): View
    {
        // Retrieve session data
        $formData = $request->session()->get('formData');

        return view('auth.register', compact('formData'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */

    public function sendOTP(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'phone_number' => ['required', 'string', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
        $phoneNumber = $data['phone_number'];

        // Store data in session
        $request->session()->put('formData', $data);

        $this->twilioService->sendOTP($phoneNumber);

        return redirect()->route('register.index')->with('phone_number', $phoneNumber);
    }

    public function verifyOTP(Request $request)
    {
        $data = $request->validate(([
            'phone_number' => ['required', 'string', 'unique:users'],
            'verification_code' => ['required', 'numeric'],
        ]));

        $otp = $data['verification_code'];
        $phoneNumber = $data['phone_number'];

        // Retrieve data from session
        $formData = $request->session()->get('formData');

        try {
            if ($this->twilioService->verifyOTP($phoneNumber, $otp)) {
                $user = User::create([
                    'name' => $formData['name'],
                    'email' => $formData['email'],
                    'phone_number' => $data['phone_number'],
                    'password' => Hash::make($formData['password']),
                    'isVerified' => true,
                ]);
                Auth::login($user);
                $request->session()->forget('formData'); // Clear form data from session

                // Clear phone number from session
                $request->session()->forget('phone_number');

                return redirect(RouteServiceProvider::HOME);
            } else {
                return back()->withErrors(['error' => 'Invalid OTP, please try again.'])->with('phone_number', $phoneNumber);
            }
        } catch (RestException $e) {
            if ($e->getStatusCode() == 404) {
                return redirect()->back()->withErrors(['error' => 'Verification code expired, please request a new one.'])->with('phone_number', $phoneNumber);
            } else {
                // Other Twilio errors
                return redirect()->back()->withErrors(['error' => 'Something went wrong with the verification process.']);
            }
        }
    }

    public function resendOTP(Request $request)
    {
        $data = $request->validate([
            'phone_number' => ['required', 'string', 'unique:users'],
        ]);
        $phoneNumber = $data['phone_number'];
        $this->twilioService->sendOTP($phoneNumber, true); // Resending OTP

        return redirect()->back()->with('phone_number', $phoneNumber)->with('success', 'OTP resent successfully!');
    }
}
