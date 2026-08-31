<?php

namespace App\Http\Controllers\Clinical;

use App\Http\Controllers\Controller;
use App\Models\Clinical\Staff;
use App\Services\Clinical\StaffDestroyService;
use Illuminate\Http\JsonResponse;

class StaffDestroyController extends Controller
{
    public function __invoke(Staff $staff, StaffDestroyService $service): JsonResponse
    {
        $service->execute($staff);

        return response()->json(status: 204);
    }
}
