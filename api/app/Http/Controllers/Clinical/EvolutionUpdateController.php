<?php

namespace App\Http\Controllers\Clinical;

use App\Http\Controllers\Controller;
use App\Http\Requests\Clinical\EvolutionUpdateRequest;
use App\Models\Clinical\Evolution;
use App\Services\Clinical\EvolutionUpdateService;
use Illuminate\Http\JsonResponse;

class EvolutionUpdateController extends Controller
{
    public function __invoke(EvolutionUpdateRequest $request, Evolution $evolution, EvolutionUpdateService $service): JsonResponse
    {
        return response()->json($service->execute($evolution, $request->validated()));
    }
}
