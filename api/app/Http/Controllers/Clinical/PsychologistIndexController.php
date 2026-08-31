<?php

namespace App\Http\Controllers\Clinical;

use App\Http\Controllers\Controller;
use App\Models\Clinical\Psychologist;
use Illuminate\Http\JsonResponse;

class PsychologistIndexController extends Controller
{
    public function __invoke(): JsonResponse
    {
        return response()->json(
            Psychologist::with(['person', 'specialties'])->get()
        );
    }
}
