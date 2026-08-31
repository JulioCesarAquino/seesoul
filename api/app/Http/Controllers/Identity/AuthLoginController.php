<?php

namespace App\Http\Controllers\Identity;

use App\Http\Controllers\Controller;
use App\Http\Requests\Identity\AuthLoginRequest;
use App\Services\Identity\AuthLoginService;
use Illuminate\Http\JsonResponse;

class AuthLoginController extends Controller
{
    public function __invoke(AuthLoginRequest $request, AuthLoginService $service): JsonResponse
    {
        $result = $service->execute($request->validated());

        $user = $result['user'];

        return response()->json([
            'token' => $result['token'],
            'user' => $user->only(['id', 'name', 'email']),
            'tenants' => $user->tenants()->get(['tenants.id', 'name', 'subdomain']),
        ]);
    }
}
