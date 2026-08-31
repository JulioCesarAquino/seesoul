<?php

namespace App\Http\Controllers\Clinical;

use App\Http\Controllers\Controller;
use App\Http\Requests\Clinical\EvolutionStoreRequest;
use App\Services\Clinical\EvolutionStoreService;
use Illuminate\Http\JsonResponse;

class EvolutionStoreController extends Controller
{
    public function __invoke(EvolutionStoreRequest $request, EvolutionStoreService $service): JsonResponse
    {
        $evolution = $service->execute($request->validated(), $request->user()->id);

        return response()->json($evolution, 201);
    }
}
