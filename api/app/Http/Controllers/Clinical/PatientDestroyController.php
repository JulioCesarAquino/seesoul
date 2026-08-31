<?php

namespace App\Http\Controllers\Clinical;

use App\Http\Controllers\Controller;
use App\Models\Clinical\Patient;
use App\Services\Clinical\PatientDestroyService;
use Illuminate\Http\JsonResponse;

class PatientDestroyController extends Controller
{
    public function __invoke(Patient $patient, PatientDestroyService $service): JsonResponse
    {
        $service->execute($patient);

        return response()->json(status: 204);
    }
}
