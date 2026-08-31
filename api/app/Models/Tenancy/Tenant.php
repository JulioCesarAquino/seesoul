<?php

namespace App\Models\Tenancy;

use App\Models\Clinical\Attendance;
use App\Models\Clinical\Evolution;
use App\Models\Clinical\MedicalRecord;
use App\Models\Clinical\Patient;
use App\Models\Clinical\Psychologist;
use App\Models\Clinical\Staff;
use App\Models\Identity\User;
use App\Models\Scheduling\Appointment;
use App\Models\Scheduling\Availability;
use App\Models\Scheduling\ScheduleBlock;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tenant extends Model
{
    protected $fillable = [
        'name',
        'subdomain',
        'status',
        'timezone',
    ];

    /**
     * Usuários pertencentes a este tenant.
     *
     * @return BelongsToMany<User, $this>
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'tenant_users')->withTimestamps();
    }

    /**
     * @return HasMany<Patient, $this>
     */
    public function patients(): HasMany
    {
        return $this->hasMany(Patient::class);
    }

    /**
     * @return HasMany<Psychologist, $this>
     */
    public function psychologists(): HasMany
    {
        return $this->hasMany(Psychologist::class);
    }

    /**
     * @return HasMany<Staff, $this>
     */
    public function staff(): HasMany
    {
        return $this->hasMany(Staff::class);
    }

    /**
     * @return HasMany<Availability, $this>
     */
    public function availabilities(): HasMany
    {
        return $this->hasMany(Availability::class);
    }

    /**
     * @return HasMany<ScheduleBlock, $this>
     */
    public function scheduleBlocks(): HasMany
    {
        return $this->hasMany(ScheduleBlock::class);
    }

    /**
     * @return HasMany<Appointment, $this>
     */
    public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class);
    }

    /**
     * @return HasMany<MedicalRecord, $this>
     */
    public function medicalRecords(): HasMany
    {
        return $this->hasMany(MedicalRecord::class);
    }

    /**
     * @return HasMany<Attendance, $this>
     */
    public function attendances(): HasMany
    {
        return $this->hasMany(Attendance::class);
    }

    /**
     * @return HasMany<Evolution, $this>
     */
    public function evolutions(): HasMany
    {
        return $this->hasMany(Evolution::class);
    }
}
