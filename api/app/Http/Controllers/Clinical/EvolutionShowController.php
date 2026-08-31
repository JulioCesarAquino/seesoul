<?php

namespace App\Http\Controllers\Clinical;

use App\Http\Controllers\Controller;
use App\Models\Clinical\Evolution;
use Illuminate\Http\JsonResponse;

class EvolutionShowController extends Controller
{
    public function __invoke(Evolution $evolution): JsonResponse
    {
        return response()->json($evolution->load(['medicalRecord', 'attendance', 'author']));
    }
}
