<?php

namespace App\Models\Tenancy\Concerns;

use App\Models\Tenancy\Scopes\TenantScope;
use App\Services\Tenancy\TenantContext;
use Illuminate\Database\Eloquent\Builder;

trait BelongsToTenant
{
    protected static function bootBelongsToTenant(): void
    {
        static::addGlobalScope(new TenantScope());

        static::creating(function ($model): void {
            $context = app(TenantContext::class);

            if (! $model->getAttribute('tenant_id') && $context->check()) {
                $model->setAttribute('tenant_id', $context->id());
            }
        });
    }

    public function scopeWithoutTenant(Builder $query): Builder
    {
        return $query->withoutGlobalScope(TenantScope::class);
    }
}
