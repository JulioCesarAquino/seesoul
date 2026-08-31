<?php

namespace App\Http\Controllers\Clinical;

use App\Http\Controllers\Controller;
use App\Models\Clinical\Psychologist;
use Illuminate\Http\JsonResponse;

class PsychologistShowController extends Controller
{
    public function __invoke(Psychologist $psychologist): JsonResponse
    {
        return response()->json($psychologist->load(['person', 'specialties']));
    }
}
