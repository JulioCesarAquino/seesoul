<?php

namespace App\Http\Controllers\Clinical;

use App\Http\Controllers\Controller;
use App\Models\Clinical\Specialty;
use App\Services\Clinical\SpecialtyDestroyService;
use Illuminate\Http\JsonResponse;

class SpecialtyDestroyController extends Controller
{
    public function __invoke(Specialty $specialty, SpecialtyDestroyService $service): JsonResponse
    {
        $service->execute($specialty);

        return response()->json(status: 204);
    }
}
