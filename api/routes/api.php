<?php

use App\Http\Controllers\Api\AuthController;
use App\Services\TenantContext;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);
Route::post('/forgot-password', [AuthController::class, 'forgotPassword']);
Route::post('/reset-password', [AuthController::class, 'resetPassword']);

Route::middleware('auth:sanctum')->group(function (): void {
    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::middleware('tenant')->get('/tenant', function (Request $request) {
        return response()->json([
            'tenant' => app(TenantContext::class)->get()->only(['id', 'name', 'subdomain']),
        ]);
    });
});
