<?php

namespace App\Http\Controllers\Clinical;

use App\Http\Controllers\Controller;
use App\Models\Clinical\Patient;
use Illuminate\Http\JsonResponse;

class PatientIndexController extends Controller
{
    public function __invoke(): JsonResponse
    {
        return response()->json(
            Patient::with('person')->get()
        );
    }
}
