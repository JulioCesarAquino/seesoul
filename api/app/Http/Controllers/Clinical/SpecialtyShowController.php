<?php

namespace App\Http\Controllers\Clinical;

use App\Http\Controllers\Controller;
use App\Models\Clinical\Specialty;
use Illuminate\Http\JsonResponse;

class SpecialtyShowController extends Controller
{
    public function __invoke(Specialty $specialty): JsonResponse
    {
        return response()->json($specialty);
    }
}
