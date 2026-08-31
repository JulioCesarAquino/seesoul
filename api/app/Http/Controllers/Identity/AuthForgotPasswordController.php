<?php

namespace App\Http\Controllers\Identity;

use App\Http\Controllers\Controller;
use App\Http\Requests\Identity\AuthForgotPasswordRequest;
use App\Services\Identity\AuthForgotPasswordService;
use Illuminate\Http\JsonResponse;

class AuthForgotPasswordController extends Controller
{
    public function __invoke(AuthForgotPasswordRequest $request, AuthForgotPasswordService $service): JsonResponse
    {
        $service->execute($request->validated('email'));

        return response()->json([
            'message' => 'Se o e-mail existir, um link de recuperação foi enviado.',
        ]);
    }
}
