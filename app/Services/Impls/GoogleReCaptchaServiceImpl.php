<?php

namespace App\Services\Impls;

use App\Services\GoogleReCaptchaService;
use Illuminate\Support\Facades\Http;

class GoogleReCaptchaServiceImpl extends GenericServiceImpl implements GoogleReCaptchaService {
    public function verify($token) {
        $payload = [
            'secret' => config('googlerecaptcha.secret'),
            'response' => $token,
        ];
        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', $payload);
        $resData = $response->json();
        if (!$response->successful() || !$resData['success']) {
            return false;
        }
        return true;
    }
}
