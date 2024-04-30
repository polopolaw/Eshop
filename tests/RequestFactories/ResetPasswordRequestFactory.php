<?php

namespace Tests\RequestFactories;

use Worksome\RequestFactories\RequestFactory;

class ResetPasswordRequestFactory extends RequestFactory
{
    public function definition(): array
    {
        $password = $this->faker->password(15);

        return [
            'token' => str()->random(20),
            'email' => $this->faker->email,
            'password' => $password,
            'password_confirmation' => $password
        ];
    }
}
