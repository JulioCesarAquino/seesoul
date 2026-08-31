<?php

namespace App\Http\Controllers\Clinical;

use App\Http\Controllers\Controller;
use App\Models\Clinical\Attendance;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AttendanceIndexController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        return response()->json(
            Attendance::with(['appointment', 'patient', 'psychologist'])
                ->when($request->query('patient_id'), fn ($query, $patientId) => $query->where('patient_id', $patientId))
                ->when($request->query('psychologist_id'), fn ($query, $psychologistId) => $query->where('psychologist_id', $psychologistId))
                ->get()
        );
    }
}
