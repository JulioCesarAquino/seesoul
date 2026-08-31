<?php

namespace App\Http\Controllers\Clinical;

use App\Http\Controllers\Controller;
use App\Http\Requests\Clinical\AttendanceStoreRequest;
use App\Services\Clinical\AttendanceStoreService;
use Illuminate\Http\JsonResponse;

class AttendanceStoreController extends Controller
{
    public function __invoke(AttendanceStoreRequest $request, AttendanceStoreService $service): JsonResponse
    {
        return response()->json($service->execute($request->validated()), 201);
    }
}
