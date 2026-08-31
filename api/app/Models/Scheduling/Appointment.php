<?php

namespace App\Models\Scheduling;

use App\Models\Clinical\Attendance;
use App\Models\Clinical\Patient;
use App\Models\Clinical\Psychologist;
use App\Models\Tenancy\Concerns\BelongsToTenant;
use App\Models\Tenancy\Tenant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Appointment extends Model
{
    use BelongsToTenant;

    public const STATUS_SCHEDULED = 'scheduled';

    public const STATUS_CONFIRMED = 'confirmed';

    public const STATUS_COMPLETED = 'completed';

    public const STATUS_CANCELLED = 'cancelled';

    public const STATUS_NO_SHOW = 'no_show';

    public const STATUSES = [
        self::STATUS_SCHEDULED,
        self::STATUS_CONFIRMED,
        self::STATUS_COMPLETED,
        self::STATUS_CANCELLED,
        self::STATUS_NO_SHOW,
    ];

    protected $fillable = [
        'tenant_id',
        'psychologist_id',
        'patient_id',
        'starts_at',
        'ends_at',
        'status',
        'notes',
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
     * @return BelongsTo<Patient, $this>
     */
    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }

    /**
     * @return BelongsTo<Tenant, $this>
     */
    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }

    /**
     * @return HasOne<Attendance, $this>
     */
    public function attendance(): HasOne
    {
        return $this->hasOne(Attendance::class);
    }
}
