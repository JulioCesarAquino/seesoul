<?php

namespace App\Http\Controllers\Identity;

use App\Http\Controllers\Controller;
use App\Services\Identity\AuthLogoutService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthLogoutController extends Controller
{
    public function __invoke(Request $request, AuthLogoutService $service): JsonResponse
    {
        $service->execute($request->user());

        return response()->json(status: 204);
    }
}
