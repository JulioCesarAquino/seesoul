<?php

namespace App\Http\Controllers\Clinical;

use App\Http\Controllers\Controller;
use App\Http\Requests\Clinical\MedicalRecordStoreRequest;
use App\Services\Clinical\MedicalRecordStoreService;
use Illuminate\Http\JsonResponse;

class MedicalRecordStoreController extends Controller
{
    public function __invoke(MedicalRecordStoreRequest $request, MedicalRecordStoreService $service): JsonResponse
    {
        return response()->json($service->execute($request->validated()), 201);
    }
}
