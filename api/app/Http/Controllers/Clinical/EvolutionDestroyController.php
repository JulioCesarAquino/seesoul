<?php

namespace App\Http\Controllers\Clinical;

use App\Http\Controllers\Controller;
use App\Models\Clinical\Evolution;
use App\Services\Clinical\EvolutionDestroyService;
use Illuminate\Http\JsonResponse;

class EvolutionDestroyController extends Controller
{
    public function __invoke(Evolution $evolution, EvolutionDestroyService $service): JsonResponse
    {
        $service->execute($evolution);

        return response()->json(status: 204);
    }
}
