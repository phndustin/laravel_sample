<?php

namespace App\Services\Impls;

use App\Services\UserService;
use App\Services\Google2faService;
use App\Repositories\Google2faQrcodeRepository;
use App\Services\AuthService;
use App\Repositories\TransactionRepository;
use App\Repositories\UserRepository;
use Illuminate\Auth\AuthenticationException;
use App\Repositories\MailVerificationRepository;
use App\Helpers\AppHelper;
use Str;
use Mail;
use App\Mail\VerifyMail;
use App\Exceptions\BusinessException;

class UserServiceImpl extends GenericServiceImpl implements UserService {
    private $google2faQrcodeRepository;
    private $authService;
    private $transactionRepository;
    private $userRepository;
    private $mailVerificationRepository;

    public function __construct(
        Google2faQrcodeRepository $google2faQrcodeRepository,
        AuthService $authService,
        TransactionRepository $transactionRepository,
        UserRepository $userRepository,
        MailVerificationRepository $mailVerificationRepository
    ) {
        $this->google2faQrcodeRepository = $google2faQrcodeRepository;
        $this->authService = $authService;
        $this->transactionRepository = $transactionRepository;
        $this->userRepository = $userRepository;
        $this->mailVerificationRepository = $mailVerificationRepository;
    }

    public function generateGoogle2faQRCode() {
        $user = auth()->user();

        $userQRcode = $this->google2faQrcodeRepository
            ->where('user_id', $user->id)
            ->lockForUpdate()
            ->first();
        if (!$userQRcode) {
            $qrcode = app(Google2faService::class)->generateQRCode($user);
            $userQRcode = $this->google2faQrcodeRepository
                ->create([
                    'user_id'    => $user->id,
                    'secret'     => $qrcode['secret'],
                    'qrcode'     => $qrcode['url'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
        }
        return $userQRcode;
    }

    public function getMe() {
        return auth()->user();
    }
}
