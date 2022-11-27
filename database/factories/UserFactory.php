<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'email'       => $this->faker->email,
            'first_name'  => $this->faker->firstName,
            'last_name'   => $this->faker->lastName,
            'password'    => '$2a$12$jC4naeJV65mYpoPy30H1N.xHSNdssuS/hCKI50NrWacDEEpQ.oiTe', // Admin@o123456789
            'username'    => 'test',
            'ip'          => '127.0.0.1',
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'is_verified_mail' => false,
                'verified_email_at' => null,
            ];
        });
    }

    public function verified()
    {
        return $this->state(function (array $attributes) {
            return [
                'is_verified_mail' => true,
                'verified_email_at' => now(),
            ];
        });
    }
}
