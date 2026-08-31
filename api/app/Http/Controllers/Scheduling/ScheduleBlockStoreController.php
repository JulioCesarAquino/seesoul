<?php

namespace App\Http\Controllers\Scheduling;

use App\Http\Controllers\Controller;
use App\Http\Requests\Scheduling\ScheduleBlockStoreRequest;
use App\Services\Scheduling\ScheduleBlockStoreService;
use Illuminate\Http\JsonResponse;

class ScheduleBlockStoreController extends Controller
{
    public function __invoke(ScheduleBlockStoreRequest $request, ScheduleBlockStoreService $service): JsonResponse
    {
        return response()->json($service->execute($request->validated()), 201);
    }
}
