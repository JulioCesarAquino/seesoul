<?php

namespace App\Http\Controllers\Clinical;

use App\Http\Controllers\Controller;
use App\Http\Requests\Clinical\StaffUpdateRequest;
use App\Models\Clinical\Staff;
use App\Services\Clinical\StaffUpdateService;
use Illuminate\Http\JsonResponse;

class StaffUpdateController extends Controller
{
    public function __invoke(StaffUpdateRequest $request, Staff $staff, StaffUpdateService $service): JsonResponse
    {
        return response()->json($service->execute($staff, $request->validated()));
    }
}
