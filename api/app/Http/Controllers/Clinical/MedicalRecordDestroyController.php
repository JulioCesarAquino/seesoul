<?php

namespace App\Http\Controllers\Clinical;

use App\Http\Controllers\Controller;
use App\Models\Clinical\MedicalRecord;
use App\Services\Clinical\MedicalRecordDestroyService;
use Illuminate\Http\JsonResponse;

class MedicalRecordDestroyController extends Controller
{
    public function __invoke(MedicalRecord $medicalRecord, MedicalRecordDestroyService $service): JsonResponse
    {
        $service->execute($medicalRecord);

        return response()->json(status: 204);
    }
}
