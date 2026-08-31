<?php

namespace App\Http\Controllers\Clinical;

use App\Http\Controllers\Controller;
use App\Models\Clinical\Attendance;
use Illuminate\Http\JsonResponse;

class AttendanceShowController extends Controller
{
    public function __invoke(Attendance $attendance): JsonResponse
    {
        return response()->json($attendance->load(['appointment', 'patient', 'psychologist', 'evolutions']));
    }
}
