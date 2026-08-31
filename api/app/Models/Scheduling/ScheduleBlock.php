<?php

namespace App\Models\Scheduling;

use App\Models\Clinical\Psychologist;
use App\Models\Tenancy\Concerns\BelongsToTenant;
use App\Models\Tenancy\Tenant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ScheduleBlock extends Model
{
    use BelongsToTenant;

    protected $fillable = [
        'tenant_id',
        'psychologist_id',
        'starts_at',
        'ends_at',
        'reason',
    ];

    protected function casts(): array
    {
        return [
            'starts_at' => 'datetime',
            'ends_at' => 'datetime',
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
