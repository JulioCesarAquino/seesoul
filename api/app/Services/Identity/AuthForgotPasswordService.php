<?php

namespace App\Services\Identity;

use Illuminate\Support\Facades\Password;

class AuthForgotPasswordService
{
    public function execute(string $email): void
    {
        Password::sendResetLink(['email' => $email]);
    }
}
