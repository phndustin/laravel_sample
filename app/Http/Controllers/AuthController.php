<?php

namespace App\Http\Controllers;

use DB;
use Google2FA;
use App\Services\UserService;
use Mail;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SignInRequest;
use App\Http\Resources\ApiResource;
use App\Services\AuthService;
use App\Http\Requests\SignUpRequest;
use App\Http\Requests\VerifyGoogle2faRequest;

class AuthController extends Controller
{
    private $authService;
    private $userService;

    public function __construct(
        AuthService $authService,
        UserService $userService
    ) {
        $this->authService = $authService;
        $this->userService = $userService;
    }

    public function signUp(SignUpRequest $request) {
        try {
            DB::beginTransaction();
            $user = $this->authService->signUp($request);
            DB::commit();
        } catch(Exception $e) {
            DB::rollback();
            throw $e;
        }
        return new ApiResource([
            'user' => $user,
        ]);
    }

    public function signIn(SignInRequest $request) {
        $token = $this->authService->signIn($request);
        if ($token) {
            $user = $this->userService->getMe();
        } else {
            $user = $this->userService->getMeWithoutAuth();
        }

        return new ApiResource([
            'token' => $token,
            'user' => $user,
        ]);
    }

    public function verifyGoogle2fa(VerifyGoogle2faRequest $request) {
        $token = $this->authService->verifyGoogle2fa($request);
        $user = $this->userService->getMe();

        return new ApiResource([
            'token' => $token,
            'user' => $user,
        ]);
    }

    public function signOut() {
        $this->authService->signOut();
        return new ApiResource([]);
    }
}
