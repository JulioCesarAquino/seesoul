<?php

namespace App\Http\Controllers\Clinical;

use App\Http\Controllers\Controller;
use App\Models\Clinical\Staff;
use Illuminate\Http\JsonResponse;

class StaffShowController extends Controller
{
    public function __invoke(Staff $staff): JsonResponse
    {
        return response()->json($staff->load('person'));
    }
}
