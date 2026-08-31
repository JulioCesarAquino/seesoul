<?php

namespace App\Models\Clinical;

use App\Models\Scheduling\Appointment;
use App\Models\Tenancy\Concerns\BelongsToTenant;
use App\Models\Tenancy\Tenant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attendance extends Model
{
    use BelongsToTenant, SoftDeletes;

    protected $fillable = [
        'tenant_id',
        'appointment_id',
        'patient_id',
        'psychologist_id',
        'occurred_at',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'occurred_at' => 'datetime',
        ];
    }

    /**
     * @return BelongsTo<Appointment, $this>
     */
    public function appointment(): BelongsTo
    {
        return $this->belongsTo(Appointment::class);
    }

    /**
     * @return BelongsTo<Patient, $this>
     */
    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
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

    /**
     * @return HasMany<Evolution, $this>
     */
    public function evolutions(): HasMany
    {
        return $this->hasMany(Evolution::class);
    }
}
