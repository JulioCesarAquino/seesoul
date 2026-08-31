<?php

namespace App\Services\Scheduling;

use App\Models\Scheduling\Appointment;
use Illuminate\Support\Carbon;

class AppointmentUpdateService
{
    public function __construct(
        private readonly AppointmentConflictChecker $conflictChecker,
    ) {
    }

    /**
     * @param  array<string, mixed>  $data
     */
    public function execute(Appointment $appointment, array $data): Appointment
    {
        if (isset($data['starts_at'])) {
            $startsAt = Carbon::parse($data['starts_at'])->utc();
            $endsAt = Carbon::parse($data['ends_at'])->utc();

            $this->conflictChecker->assertAvailable($appointment->psychologist, $startsAt, $endsAt, ignoring: $appointment);

            $data['starts_at'] = $startsAt;
            $data['ends_at'] = $endsAt;
        }

        $appointment->update($data);

        return $appointment->load(['psychologist', 'patient']);
    }
}
