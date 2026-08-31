<?php

namespace App\Http\Controllers\Clinical;

use App\Http\Controllers\Controller;
use App\Models\Clinical\MedicalRecord;
use Illuminate\Http\JsonResponse;

class MedicalRecordShowController extends Controller
{
    public function __invoke(MedicalRecord $medicalRecord): JsonResponse
    {
        return response()->json($medicalRecord->load(['patient', 'evolutions']));
    }
}
