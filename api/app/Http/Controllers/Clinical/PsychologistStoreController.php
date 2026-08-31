<?php

namespace App\Http\Controllers\Clinical;

use App\Http\Controllers\Controller;
use App\Http\Requests\Clinical\PsychologistStoreRequest;
use App\Services\Clinical\PsychologistStoreService;
use Illuminate\Http\JsonResponse;

class PsychologistStoreController extends Controller
{
    public function __invoke(PsychologistStoreRequest $request, PsychologistStoreService $service): JsonResponse
    {
        $psychologist = $service->execute($request->validated());

        return response()->json($psychologist, 201);
    }
}
