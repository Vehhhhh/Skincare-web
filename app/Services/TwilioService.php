<?php

namespace App\Services;

use Twilio\Rest\Client;

class TwilioService
{
    protected $twilio;

    public function __construct()
    {
        $sid = env('TWILIO_SID');
        $token = env('TWILIO_AUTH_TOKEN');
        $this->twilio = new Client($sid, $token);
    }

    public function sendOTP($phoneNumber, $resend = false)
    {
        $twilio_verify_sid = env('TWILIO_VERIFY_SID');

        try {
            // If it's a resend, we want to send a new OTP
            if ($resend) {
                $this->twilio->verify->v2->services($twilio_verify_sid)
                    ->verifications
                    ->create($phoneNumber, "sms", ['new_code_lifetime' => 180]); // Specify a new code lifetime if needed
            } else {
                // If it's not a resend, we want to initiate a new verification
                $this->twilio->verify->v2->services($twilio_verify_sid)
                    ->verifications
                    ->create($phoneNumber, "sms");
            }
        } catch (\Twilio\Exceptions\RestException $e) {
            return $e->getMessage(); // Returning the error message
        }
    }

    public function verifyOTP($phoneNumber, $otp)
    {
        $twilio_verify_sid = env('TWILIO_VERIFY_SID');
        $verification = $this->twilio->verify->v2->services($twilio_verify_sid)
            ->verificationChecks
            ->create(['code' => $otp, 'to' => $phoneNumber]);
        return $verification->status == 'approved';
    }
}
