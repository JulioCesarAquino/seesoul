<?php

namespace App\Http\Controllers\Clinical;

use App\Http\Controllers\Controller;
use App\Models\Clinical\Patient;
use Illuminate\Http\JsonResponse;

class PatientShowController extends Controller
{
    public function __invoke(Patient $patient): JsonResponse
    {
        return response()->json($patient->load('person'));
    }
}
