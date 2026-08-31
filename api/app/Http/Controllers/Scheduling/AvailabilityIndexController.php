<?php

namespace App\Http\Controllers\Scheduling;

use App\Http\Controllers\Controller;
use App\Models\Scheduling\Availability;
use Illuminate\Http\JsonResponse;

class AvailabilityIndexController extends Controller
{
    public function __invoke(): JsonResponse
    {
        return response()->json(
            Availability::with('psychologist')->get()
        );
    }
}
