<?php

namespace App\Http\Controllers\Scheduling;

use App\Http\Controllers\Controller;
use App\Http\Requests\Scheduling\AvailabilityStoreRequest;
use App\Services\Scheduling\AvailabilityStoreService;
use Illuminate\Http\JsonResponse;

class AvailabilityStoreController extends Controller
{
    public function __invoke(AvailabilityStoreRequest $request, AvailabilityStoreService $service): JsonResponse
    {
        return response()->json($service->execute($request->validated()), 201);
    }
}
