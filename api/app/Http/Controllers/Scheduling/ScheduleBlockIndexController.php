<?php

namespace App\Http\Controllers\Scheduling;

use App\Http\Controllers\Controller;
use App\Models\Scheduling\ScheduleBlock;
use Illuminate\Http\JsonResponse;

class ScheduleBlockIndexController extends Controller
{
    public function __invoke(): JsonResponse
    {
        return response()->json(
            ScheduleBlock::with('psychologist')->get()
        );
    }
}
