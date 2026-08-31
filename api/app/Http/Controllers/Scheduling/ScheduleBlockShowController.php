<?php

namespace App\Http\Controllers\Scheduling;

use App\Http\Controllers\Controller;
use App\Models\Scheduling\ScheduleBlock;
use Illuminate\Http\JsonResponse;

class ScheduleBlockShowController extends Controller
{
    public function __invoke(ScheduleBlock $scheduleBlock): JsonResponse
    {
        return response()->json($scheduleBlock->load('psychologist'));
    }
}
