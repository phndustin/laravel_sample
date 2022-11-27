<?php

namespace App\Services;

interface GoogleReCaptchaService extends GenericService {
    public function verify($token);
}
