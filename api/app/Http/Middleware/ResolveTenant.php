<?php

namespace App\Http\Middleware;

use App\Models\Tenant;
use App\Services\TenantContext;
use Closure;
use Illuminate\Http\Request;
use Spatie\Permission\PermissionRegistrar;
use Symfony\Component\HttpFoundation\Response;

class ResolveTenant
{
    public function handle(Request $request, Closure $next): Response
    {
        $host = $request->getHost();
        $parts = explode('.', $host);

        if (count($parts) < 2) {
            abort(404, 'Tenant não identificado.');
        }

        $subdomain = $parts[0];

        $tenant = Tenant::where('subdomain', $subdomain)->first();

        if (! $tenant || $tenant->status !== 'active') {
            abort(404, 'Tenant não encontrado.');
        }

        if ($request->user() && ! $request->user()->tenants()->where('tenants.id', $tenant->id)->exists()) {
            abort(403, 'Usuário não pertence a este tenant.');
        }

        app(TenantContext::class)->set($tenant);
        app(PermissionRegistrar::class)->setPermissionsTeamId($tenant->id);

        return $next($request);
    }
}
