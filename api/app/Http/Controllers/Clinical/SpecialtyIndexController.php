<?php

namespace App\Http\Controllers\Clinical;

use App\Http\Controllers\Controller;
use App\Models\Clinical\Specialty;
use Illuminate\Http\JsonResponse;

class SpecialtyIndexController extends Controller
{
    public function __invoke(): JsonResponse
    {
        return response()->json(Specialty::orderBy('name')->get());
    }
}
