<?php

namespace App\Services\Identity;

use App\Models\Identity\User;

class AuthLogoutService
{
    public function execute(User $user): void
    {
        $user->currentAccessToken()->delete();
    }
}
