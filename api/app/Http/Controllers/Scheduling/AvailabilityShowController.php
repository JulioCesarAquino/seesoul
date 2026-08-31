<?php

namespace App\Http\Controllers\Scheduling;

use App\Http\Controllers\Controller;
use App\Models\Scheduling\Availability;
use Illuminate\Http\JsonResponse;

class AvailabilityShowController extends Controller
{
    public function __invoke(Availability $availability): JsonResponse
    {
        return response()->json($availability->load('psychologist'));
    }
}
