<?php

namespace App\Http\Controllers\Scheduling;

use App\Http\Controllers\Controller;
use App\Http\Requests\Scheduling\ScheduleBlockUpdateRequest;
use App\Models\Scheduling\ScheduleBlock;
use App\Services\Scheduling\ScheduleBlockUpdateService;
use Illuminate\Http\JsonResponse;

class ScheduleBlockUpdateController extends Controller
{
    public function __invoke(ScheduleBlockUpdateRequest $request, ScheduleBlock $scheduleBlock, ScheduleBlockUpdateService $service): JsonResponse
    {
        return response()->json($service->execute($scheduleBlock, $request->validated()));
    }
}
