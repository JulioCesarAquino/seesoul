<?php

namespace App\Http\Controllers\Clinical;

use App\Http\Controllers\Controller;
use App\Http\Requests\Clinical\SpecialtyUpdateRequest;
use App\Models\Clinical\Specialty;
use App\Services\Clinical\SpecialtyUpdateService;
use Illuminate\Http\JsonResponse;

class SpecialtyUpdateController extends Controller
{
    public function __invoke(SpecialtyUpdateRequest $request, Specialty $specialty, SpecialtyUpdateService $service): JsonResponse
    {
        return response()->json($service->execute($specialty, $request->validated()));
    }
}
