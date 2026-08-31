<?php

namespace App\Http\Controllers\Identity;

use App\Http\Controllers\Controller;
use App\Http\Requests\Identity\AuthResetPasswordRequest;
use App\Services\Identity\AuthResetPasswordService;
use Illuminate\Http\JsonResponse;

class AuthResetPasswordController extends Controller
{
    public function __invoke(AuthResetPasswordRequest $request, AuthResetPasswordService $service): JsonResponse
    {
        $service->execute($request->validated());

        return response()->json([
            'message' => 'Senha atualizada com sucesso.',
        ]);
    }
}
