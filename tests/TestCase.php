<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Mockery;
use Mockery\MockInterface;
use App\Services\Google2faService;
use App\Services\GoogleReCaptchaService;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function mockingService() {
        $this->instance(
            Google2faService::class,
            Mockery::mock(Google2faService::class, function (MockInterface $mock) {
                $mock->shouldReceive('verifyOTP')->andReturn(null);
                $mock->shouldReceive('generateQRCode')->andReturn([
                    'secret' => 'secret',
                    'url' => 'url',
                ]);
            })
        );

        $this->instance(
            GoogleReCaptchaService::class,
            Mockery::mock(GoogleReCaptchaService::class, function (MockInterface $mock) {
                $mock->shouldReceive('verify')->andReturn(true);
            })
        );
    }
}
