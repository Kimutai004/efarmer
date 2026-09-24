<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     *
     * @var string|null
     */
    protected static $password;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'national_id' => $this->faker->unique()->numerify('########'),
            'gender' => $this->faker->randomElement(['Male', 'Female']),
            'phone' => '2547' . $this->faker->numerify('########'),
            'alternative_phone' => null,
            'email' => $this->faker->unique()->safeEmail(),

            'password' => static::$password ??= Hash::make('password123'),

            'email_verified' => true,
            'email_verified_at' => now(),

            'phone_verified_at' => null,

            'last_login_at' => null,
            'last_login_ip' => null,
            'last_logout_at' => null,

            'login_count' => 0,

            'status' => 'active',

            'suspended_at' => null,
            'suspension_reason' => null,

            'remember_token' => null,
        ];
    }

    /**
     * Indicate that the user's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified' => false,
                'email_verified_at' => null,
            ];
        });
    }
}
