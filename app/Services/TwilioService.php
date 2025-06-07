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
        if (!$twilio_verify_sid) {
            throw new \Exception("Verify SID not configured.");
        }

        $verificationService = $this->twilio->verify->v2->services($twilio_verify_sid);

        if ($resend) {
            $verificationService->verifications
                ->create($phoneNumber, "sms", ['new_code_lifetime' => 180]);
        } else {
            $verificationService->verifications
                ->create($phoneNumber, "sms");
        }
    } catch (\Exception $e) {
        return $e->getMessage(); // Log this in real apps
    }
}


   public function verifyOTP($phoneNumber, $otp)
{
    $twilio_verify_sid = env('TWILIO_VERIFY_SID');

    if (!$twilio_verify_sid) {
        return "Missing TWILIO_VERIFY_SID in .env";
    }

    try {
        if (!$otp || !$phoneNumber) {
            return "Missing OTP or phone number.";
        }

        $verification = $this->twilio->verify->v2->services($twilio_verify_sid)
            ->verificationChecks
            ->create([
                'to' => $phoneNumber,
                'code' => $otp,
            ]);

        return $verification->status === 'approved';
    } catch (\Twilio\Exceptions\RestException $e) {
        return 'Twilio Error: ' . $e->getMessage() . ' (Code: ' . $e->getCode() . ')';
    } catch (\Exception $e) {
        return 'General Error: ' . $e->getMessage();
    }
}

}
