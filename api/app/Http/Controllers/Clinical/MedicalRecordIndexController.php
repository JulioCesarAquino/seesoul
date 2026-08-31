<?php

namespace App\Http\Controllers\Clinical;

use App\Http\Controllers\Controller;
use App\Models\Clinical\MedicalRecord;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MedicalRecordIndexController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        return response()->json(
            MedicalRecord::with('patient')
                ->when($request->query('patient_id'), fn ($query, $patientId) => $query->where('patient_id', $patientId))
                ->get()
        );
    }
}
