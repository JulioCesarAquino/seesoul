<?php

namespace App\Http\Controllers\Scheduling;

use App\Http\Controllers\Controller;
use App\Models\Scheduling\ScheduleBlock;
use App\Services\Scheduling\ScheduleBlockDestroyService;
use Illuminate\Http\JsonResponse;

class ScheduleBlockDestroyController extends Controller
{
    public function __invoke(ScheduleBlock $scheduleBlock, ScheduleBlockDestroyService $service): JsonResponse
    {
        $service->execute($scheduleBlock);

        return response()->json(status: 204);
    }
}
