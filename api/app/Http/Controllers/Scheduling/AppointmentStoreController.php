<?php

namespace App\Http\Controllers\Scheduling;

use App\Http\Controllers\Controller;
use App\Http\Requests\Scheduling\AppointmentStoreRequest;
use App\Services\Scheduling\AppointmentStoreService;
use Illuminate\Http\JsonResponse;

class AppointmentStoreController extends Controller
{
    public function __invoke(AppointmentStoreRequest $request, AppointmentStoreService $service): JsonResponse
    {
        return response()->json($service->execute($request->validated()), 201);
    }
}
