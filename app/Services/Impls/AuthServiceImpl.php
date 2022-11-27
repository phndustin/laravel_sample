<?php

namespace App\Services\Impls;

use App\Services\AuthService;
use App\Repositories\UserRepository;
use Hash;
use App\Mail\WelcomeMail;
use Mail;
use Illuminate\Auth\AuthenticationException;
use App\Exceptions\BusinessException;
use Str;
use App\Helpers\AppHelper;
use Google2FA;
use App\Repositories\Google2faQrcodeRepository;
use App\Services\Google2faService;
use App\Mail\VerifyMail;
use App\Repositories\MailVerificationRepository;
use Cache;
use App\Services\GoogleReCaptchaService;

class AuthServiceImpl extends GenericServiceImpl implements AuthService {
    private $userRepository;
    private $cryptoTagRepository;
    private $payLinkRepository;
    private $walletRepository;
    private $rewardService;
    private $passwordResetRepository;
    private $google2faQrcodeRepository;
    private $mailVerificationRepository;

    public function __construct(
        UserRepository $userRepository,
        Google2faQrcodeRepository $google2faQrcodeRepository,
        MailVerificationRepository $mailVerificationRepository
    ) {
        $this->userRepository = $userRepository;
        $this->cryptoTagRepository = $cryptoTagRepository;
        $this->payLinkRepository = $payLinkRepository;
        $this->walletRepository = $walletRepository;
        $this->rewardService = $rewardService;
        $this->passwordResetRepository = $passwordResetRepository;
        $this->google2faQrcodeRepository = $google2faQrcodeRepository;
        $this->mailVerificationRepository = $mailVerificationRepository;
    }

    public function signUp($request) {
        $validCaptcha = app(GoogleReCaptchaService::class)->verify($request->input('grecaptcha'));
        if (!$validCaptcha) {
            throw new BusinessException('captcha.invalid');
        }

        $user = $this->userRepository->create([
            'username'    => $request->input('username'),
            'first_name'  => $request->input('first_name'),
            'last_name'   => $request->input('last_name'),
            'email'       => $request->input('email'),
            'ip'          => $request->ip(),
            'password'    => Hash::make($request->input('password')),
            'created_at'  => now(),
            'updated_at'  => now(),
        ]);

        // Send verification mail
        $token = Str::random(40);
        $this->mailVerificationRepository->create([
            'email'      => $user->email,
            'token'      => $token,
            'created_at' => now(),
        ]);

        $activeUrl = AppHelper::getFEUrl(sprintf('/verify-email?email=%s&token=%s', $user->email, $token));
        Mail::to($user)->send(new VerifyMail('Email Verification.', $user, $activeUrl));
        return $user;
    }

    public function signIn($request) {
        $user = $this->userRepository->findOneByUsername($request->input('username'));
        if (!$user) {
            throw new AuthenticationException();
        }

        $enabledGoogle2fa = $user->is_google2fa;
        if ($enabledGoogle2fa) {
            return null;
        }

        // Verify captcha
        $validCaptcha = app(GoogleReCaptchaService::class)->verify($request->input('grecaptcha'));
        if (!$validCaptcha) {
            throw new BusinessException('captcha.invalid');
        }


        $credentials = [
            'username' => $request->input('username'),
            'password' => $request->input('password'),
        ];
        $token = auth()->attempt($credentials);
        if (!$token) {
            throw new AuthenticationException();
        }
        return $token;
    }

    public function verifyGoogle2fa($request) {
        $user = $this->userRepository->findOneByUsername($request->input('username'));
        if (!$user) {
            throw new AuthenticationException();
        }

        // Verify otp
        if ($user->is_google2fa) {
            app(Google2faService::class)->verifyOTP($user, $request->input('otp', null));
        }

        // verify credential
        $credentials = [
            'username' => $request->input('username'),
            'password' => $request->input('password'),
        ];
        $token = auth()->attempt($credentials);
        if (!$token) {
            throw new AuthenticationException();
        }

        return $token;
    }

    public function signOut() {
        auth()->logout();
    }
}
