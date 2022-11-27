<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Mockery;
use Mockery\MockInterface;
use App\Services\Google2faService;
use Tests\Mocking\Services\Google2faServiceFake;
use App\Models\User;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\Traits\WithAccessToken;

class Google2FaTest extends TestCase
{
    use RefreshDatabase, WithFaker, WithAccessToken;

    protected function setUp(): void {
        parent::setUp();
        $this->mockingService();
        $this->mockUpAccount();
        $this->enableGoogle2Fa();
    }

    private function enableGoogle2Fa() {
        User::where('email', $this->getmockUpAccount()['email'])
            ->update([
                'is_google2fa' => true,
            ]);
    }

    public function test_verify_otp_with_email() {
        $account = $this->getmockUpAccount();
        $postData = [
            'email'      => $account['email'],
            'otp'        => '123456',
            'password'   => $account['password'],
        ];
        $this->postJson(route('user.otp'), $postData)
            ->assertStatus(200)
            ->assertJson(fn (AssertableJson $json) =>
                $json->whereType('token', 'string')
                    ->etc()
            );
    }

    public function test_verify_otp_with_tag() {
        $account = $this->getmockUpAccount();
        $postData = [
            'tag'        => $account['tag'],
            'otp'        => '123456',
            'password'   => $account['password'],
        ];
        $this->postJson(route('user.otp'), $postData)
            ->assertStatus(200)
            ->assertJson(fn (AssertableJson $json) =>
                $json->whereType('token', 'string')
                    ->etc()
            );
    }
}
