<?php

namespace App\Http\Controllers\Scheduling;

use App\Http\Controllers\Controller;
use App\Models\Scheduling\Appointment;
use Illuminate\Http\JsonResponse;

class AppointmentIndexController extends Controller
{
    public function __invoke(): JsonResponse
    {
        return response()->json(
            Appointment::with(['psychologist', 'patient'])->get()
        );
    }
}
