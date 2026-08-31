<?php

namespace App\Http\Controllers\Scheduling;

use App\Http\Controllers\Controller;
use App\Models\Scheduling\Appointment;
use Illuminate\Http\JsonResponse;

class AppointmentShowController extends Controller
{
    public function __invoke(Appointment $appointment): JsonResponse
    {
        return response()->json($appointment->load(['psychologist', 'patient']));
    }
}
