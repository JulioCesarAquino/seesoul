<?php

namespace App\Models\Scheduling;

use App\Models\Clinical\Psychologist;
use App\Models\Tenancy\Concerns\BelongsToTenant;
use App\Models\Tenancy\Tenant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Availability extends Model
{
    use BelongsToTenant;

    protected $fillable = [
        'tenant_id',
        'psychologist_id',
        'weekday',
        'start_time',
        'end_time',
    ];

    protected function casts(): array
    {
        return [
            'weekday' => 'integer',
        ];
    }

    /**
     * @return BelongsTo<Psychologist, $this>
     */
    public function psychologist(): BelongsTo
    {
        return $this->belongsTo(Psychologist::class);
    }

    /**
     * @return BelongsTo<Tenant, $this>
     */
    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }
}
