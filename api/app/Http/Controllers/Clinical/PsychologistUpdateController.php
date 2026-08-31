<?php

namespace App\Http\Controllers\Clinical;

use App\Http\Controllers\Controller;
use App\Http\Requests\Clinical\PsychologistUpdateRequest;
use App\Models\Clinical\Psychologist;
use App\Services\Clinical\PsychologistUpdateService;
use Illuminate\Http\JsonResponse;

class PsychologistUpdateController extends Controller
{
    public function __invoke(PsychologistUpdateRequest $request, Psychologist $psychologist, PsychologistUpdateService $service): JsonResponse
    {
        return response()->json($service->execute($psychologist, $request->validated()));
    }
}
