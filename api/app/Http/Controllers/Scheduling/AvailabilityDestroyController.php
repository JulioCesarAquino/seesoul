<?php

namespace App\Http\Controllers\Scheduling;

use App\Http\Controllers\Controller;
use App\Models\Scheduling\Availability;
use App\Services\Scheduling\AvailabilityDestroyService;
use Illuminate\Http\JsonResponse;

class AvailabilityDestroyController extends Controller
{
    public function __invoke(Availability $availability, AvailabilityDestroyService $service): JsonResponse
    {
        $service->execute($availability);

        return response()->json(status: 204);
    }
}
