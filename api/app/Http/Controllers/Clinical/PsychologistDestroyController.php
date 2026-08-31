<?php

namespace App\Http\Controllers\Clinical;

use App\Http\Controllers\Controller;
use App\Models\Clinical\Psychologist;
use App\Services\Clinical\PsychologistDestroyService;
use Illuminate\Http\JsonResponse;

class PsychologistDestroyController extends Controller
{
    public function __invoke(Psychologist $psychologist, PsychologistDestroyService $service): JsonResponse
    {
        $service->execute($psychologist);

        return response()->json(status: 204);
    }
}
