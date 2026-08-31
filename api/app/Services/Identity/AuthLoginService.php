<?php

namespace App\Services\Identity;

use App\Models\Identity\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthLoginService
{
    /**
     * @param  array{email: string, password: string}  $credentials
     * @return array{token: string, user: User}
     */
    public function execute(array $credentials): array
    {
        $user = User::where('email', $credentials['email'])->first();

        if (! $user || ! Hash::check($credentials['password'], $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['As credenciais informadas não conferem.'],
            ]);
        }

        return [
            'token' => $user->createToken('api')->plainTextToken,
            'user' => $user,
        ];
    }
}
