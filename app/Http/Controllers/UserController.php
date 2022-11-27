<?php

namespace App\Http\Controllers;

use App\Http\Resources\ApiResource;
use App\Services\UserService;

class UserController extends Controller
{
    private $userService;

    public function __construct(
        UserService $userService
    ) {
        $this->userService = $userService;
    }

    public function me() {
        $user = $this->userService->getMe();
        return new ApiResource([
            'user' => $user,
        ]);
    }
}
