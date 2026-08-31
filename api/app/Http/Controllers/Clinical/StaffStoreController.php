<?php

namespace App\Http\Controllers\Clinical;

use App\Http\Controllers\Controller;
use App\Http\Requests\Clinical\StaffStoreRequest;
use App\Services\Clinical\StaffStoreService;
use Illuminate\Http\JsonResponse;

class StaffStoreController extends Controller
{
    public function __invoke(StaffStoreRequest $request, StaffStoreService $service): JsonResponse
    {
        $staff = $service->execute($request->validated());

        return response()->json($staff, 201);
    }
}
