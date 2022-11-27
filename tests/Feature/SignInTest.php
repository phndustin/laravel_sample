<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use App\Models\User;
use Tests\Traits\WithAccessToken;

class SignInTest extends TestCase
{
    use RefreshDatabase, WithFaker, WithAccessToken;

    protected function setUp(): void {
        parent::setUp();
        $this->mockingService();
        $this->mockUpAccount();
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function test_signin_email() {
        $account = $this->getmockUpAccount();
        $postData = [
            'email'      => $account['email'],
            'password'   => $account['password'],
            'grecaptcha' => 'grecaptcha',
        ];
        $this->postJson(route('user.signin'), $postData)
            ->assertStatus(200)
            ->assertJson(fn (AssertableJson $json) =>
                $json->whereType('token', 'string')
                    ->etc()
            );
    }

    public function test_signout() {
        $accessToken = $this->callSignIn()['token'];
        $this->withToken($accessToken)
            ->postJson('/api/signout')
            ->assertStatus(200);
    }
}
