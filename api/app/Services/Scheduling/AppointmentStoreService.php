<?php

namespace App\Services\Scheduling;

use App\Models\Clinical\Psychologist;
use App\Models\Scheduling\Appointment;
use Illuminate\Support\Carbon;

class AppointmentStoreService
{
    public function __construct(
        private readonly AppointmentConflictChecker $conflictChecker,
    ) {
    }

    /**
     * @param  array<string, mixed>  $data
     */
    public function execute(array $data): Appointment
    {
        $psychologist = Psychologist::findOrFail($data['psychologist_id']);
        $startsAt = Carbon::parse($data['starts_at'])->utc();
        $endsAt = Carbon::parse($data['ends_at'])->utc();

        $this->conflictChecker->assertAvailable($psychologist, $startsAt, $endsAt);

        $appointment = Appointment::create([
            'psychologist_id' => $psychologist->id,
            'patient_id' => $data['patient_id'],
            'starts_at' => $startsAt,
            'ends_at' => $endsAt,
            'status' => Appointment::STATUS_SCHEDULED,
            'notes' => $data['notes'] ?? null,
        ]);

        return $appointment->load(['psychologist', 'patient']);
    }
}
