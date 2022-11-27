<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use App\Models\User;
use Mail;
use App\Mail\VerifyMail;
use Str;
use App\Helpers\AppHelper;
use App\Services\GoogleReCaptchaService;

class SignUpTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void {
        parent::setUp();
        $this->mockingService();
    }

    public function test_create_user() {
        $postData = $this->userRegistrationBaseData();
        $this->postJson(route('user.signup'), $postData)
            ->assertStatus(200);
    }

    public function test_send_email() {
        Mail::fake();
        $postData = $this->userRegistrationBaseData();
        $this->postJson(route('user.signup'), $postData);
        Mail::assertQueued(VerifyMail::class);
    }

    public function test_resend_mail() {
        Mail::fake();
        $user = User::factory()->unverified()->create();
        $this->postJson(route('user.resend_email'), ['email' => $user->email]);
        Mail::assertQueued(VerifyMail::class);
    }

    public function test_add_verification_token() {
        $postData = $this->userRegistrationBaseData();
        $res = $this->postJson(route('user.signup'), $postData);
        $data = json_decode($res->getContent(), true);

        $this->assertDatabaseHas('mail_verifications', [
            'email' => $data['user']['email'],
        ]);
    }

    public function test_send_verification_token() {
        $user = User::factory()->unverified()->create();
        $token = Str::random(40);
        $activeUrl = AppHelper::getFEUrl(sprintf('/verify-email?email=%s&token=%s', $user->email, $token));

        $mailable = new VerifyMail('Email Verification.', $user, $activeUrl);
        $mailable->assertSeeInHtml($token);
        $mailable->assertSeeInHtml($user->email);
    }
    
    public function test_validate_unique_email() {
        $user = User::factory()->create();
        $postData = $this->userRegistrationBaseData();
        $postData['email'] = $user->email;

        $this->postJson(route('user.signup'), $postData)
            ->assertStatus(422)
            ->assertJson(fn (AssertableJson $json) =>
                $json->has('errors.email')
                    ->etc()
            );
    }

    public function test_validate_unique_tag() {
        $user = User::factory()->create();
        $postData = $this->userRegistrationBaseData();
        $postData['tag'] = $user->tag;

        $this->postJson(route('user.signup'), $postData)
            ->assertStatus(422)
            ->assertJson(fn (AssertableJson $json) =>
                $json->has('errors.tag')
                    ->etc()
            );
    }

    private function userRegistrationBaseData() {
        return [
            'email'       => $this->faker->email,
            'first_name'  => $this->faker->firstName,
            'last_name'   => $this->faker->lastName,
            'password'    => 'Admin@o123456789',
            'tag'         => 'test',
            'grecaptcha'  => 'grecaptcha',
        ];
    }
}
