<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Mail;
use App\Mail\VerifyMail;
use Tests\Traits\WithAccessToken;
use App\Models\MailVerification;

class UserTest extends TestCase
{
    use RefreshDatabase, WithFaker, WithAccessToken;

    protected function setUp(): void {
        parent::setUp();
        $this->mockingService();
        $this->initAccessToken();
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_me_api()
    {
        $this->withToken($this->accessToken)
            ->getJson('/api/me')
            ->assertStatus(200);
    }
}
