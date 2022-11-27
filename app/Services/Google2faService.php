<?php

namespace App\Services;

use App\Models\User;

interface Google2faService extends GenericService {
    public function generateQRCode(User $user);
    public function verifyOTP(User $user, $otp);
}
