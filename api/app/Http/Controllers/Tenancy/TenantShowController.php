<?php

namespace App\Http\Controllers\Tenancy;

use App\Http\Controllers\Controller;
use App\Services\Tenancy\TenantContext;
use Illuminate\Http\JsonResponse;

class TenantShowController extends Controller
{
    public function __invoke(TenantContext $tenantContext): JsonResponse
    {
        return response()->json([
            'tenant' => $tenantContext->get()->only(['id', 'name', 'subdomain']),
        ]);
    }
}
