<?php

namespace App\Http\Controllers\Clinical;

use App\Http\Controllers\Controller;
use App\Models\Clinical\Evolution;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EvolutionIndexController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        return response()->json(
            Evolution::with(['medicalRecord', 'attendance', 'author'])
                ->when($request->query('medical_record_id'), fn ($query, $medicalRecordId) => $query->where('medical_record_id', $medicalRecordId))
                ->orderByDesc('created_at')
                ->get()
        );
    }
}
