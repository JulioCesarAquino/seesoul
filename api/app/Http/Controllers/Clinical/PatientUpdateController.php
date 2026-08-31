<?php

namespace App\Http\Controllers\Clinical;

use App\Http\Controllers\Controller;
use App\Http\Requests\Clinical\PatientUpdateRequest;
use App\Models\Clinical\Patient;
use App\Services\Clinical\PatientUpdateService;
use Illuminate\Http\JsonResponse;

class PatientUpdateController extends Controller
{
    public function __invoke(PatientUpdateRequest $request, Patient $patient, PatientUpdateService $service): JsonResponse
    {
        return response()->json($service->execute($patient, $request->validated()));
    }
}
