<?php

namespace App\Http\Controllers\Scheduling;

use App\Http\Controllers\Controller;
use App\Http\Requests\Scheduling\AvailabilityUpdateRequest;
use App\Models\Scheduling\Availability;
use App\Services\Scheduling\AvailabilityUpdateService;
use Illuminate\Http\JsonResponse;

class AvailabilityUpdateController extends Controller
{
    public function __invoke(AvailabilityUpdateRequest $request, Availability $availability, AvailabilityUpdateService $service): JsonResponse
    {
        return response()->json($service->execute($availability, $request->validated()));
    }
}
