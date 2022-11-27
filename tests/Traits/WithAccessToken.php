<?php

namespace Tests\Traits;

use App\Models\MailVerification;

trait WithAccessToken {
    protected $accessToken;

    protected function initAccessToken() {
        // $this->mockingService();
        $this->mockUpAccount();
        $this->accessToken = $this->callSignIn()['token'];
    }

    protected function callSignIn($credentials = null) {
        if (!$credentials) {
            $credentials = $this->getmockUpAccount();
        }
        $postData = [
            'tag'        => $credentials['tag'],
            'password'   => $credentials['password'],
            'grecaptcha' => $credentials['grecaptcha'],
        ];
        return $this->postJson(route('user.signin'), $postData);
    }

    protected function getmockUpAccount() {
        return [
            'email'       => 'test@example.com',
            'first_name'  => $this->faker->firstName,
            'last_name'   => $this->faker->lastName,
            'password'    => 'Admin@o123456789',
            'tag'         => 'test',
            'grecaptcha'  => 'grecaptcha',
        ];
    }

    protected function mockUpAccount($postData = null) {
        if (!$postData) {
            $postData = $this->getmockUpAccount();
        }
        $this->postJson('/api/signup', $postData);
        $this->callVerifyAccount($postData['email']);
    }

    protected function callVerifyAccount($email) {
        $verify = MailVerification::where('email', $email)->first();
        if (!$verify) {
            return;
        }
        $this->postJson('/api/verify-email', [
            'email' => $email,
            'token' => $verify->token,
        ]);
    }

    protected function callSignOut($accessToken = null) {
        if (!$accessToken) {
            $accessToken = $this->accessToken;
        }
        $this->withToken($accessToken)
            ->postJson('/api/signout');
    }
}