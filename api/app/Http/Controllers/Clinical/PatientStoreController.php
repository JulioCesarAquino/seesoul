<?php

namespace App\Http\Controllers\Clinical;

use App\Http\Controllers\Controller;
use App\Services\Clinical\PatientStoreService;
use App\Http\Requests\Clinical\PatientStoreRequest;
use Illuminate\Http\JsonResponse;

class PatientStoreController extends Controller
{
    public function __invoke(PatientStoreRequest $request, PatientStoreService $service): JsonResponse
    {
        $patient = $service->execute($request->validated());

        return response()->json($patient, 201);
    }
}
