<?php

namespace App\Http\Controllers\Clinical;

use App\Http\Controllers\Controller;
use App\Http\Requests\Clinical\SpecialtyStoreRequest;
use App\Services\Clinical\SpecialtyStoreService;
use Illuminate\Http\JsonResponse;

class SpecialtyStoreController extends Controller
{
    public function __invoke(SpecialtyStoreRequest $request, SpecialtyStoreService $service): JsonResponse
    {
        return response()->json($service->execute($request->validated()), 201);
    }
}
