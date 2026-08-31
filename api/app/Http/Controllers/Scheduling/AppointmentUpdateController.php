<?php

namespace App\Http\Controllers\Scheduling;

use App\Http\Controllers\Controller;
use App\Http\Requests\Scheduling\AppointmentUpdateRequest;
use App\Models\Scheduling\Appointment;
use App\Services\Scheduling\AppointmentUpdateService;
use Illuminate\Http\JsonResponse;

class AppointmentUpdateController extends Controller
{
    public function __invoke(AppointmentUpdateRequest $request, Appointment $appointment, AppointmentUpdateService $service): JsonResponse
    {
        return response()->json($service->execute($appointment, $request->validated()));
    }
}
