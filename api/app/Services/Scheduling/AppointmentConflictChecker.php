<?php

namespace App\Services\Scheduling;

use App\Models\Clinical\Psychologist;
use App\Models\Scheduling\Appointment;
use App\Models\Scheduling\Availability;
use App\Models\Scheduling\ScheduleBlock;
use App\Services\Tenancy\TenantContext;
use Illuminate\Support\Carbon;
use Illuminate\Validation\ValidationException;

class AppointmentConflictChecker
{
    public function __construct(
        private readonly TenantContext $tenantContext,
    ) {
    }

    public function assertAvailable(Psychologist $psychologist, Carbon $startsAt, Carbon $endsAt, ?Appointment $ignoring = null): void
    {
        $timezone = $this->tenantContext->get()->timezone;
        $localStart = $startsAt->copy()->setTimezone($timezone);
        $localEnd = $endsAt->copy()->setTimezone($timezone);

        $withinAvailability = Availability::query()
            ->where('psychologist_id', $psychologist->id)
            ->where('weekday', $localStart->dayOfWeek)
            ->where('start_time', '<=', $localStart->format('H:i:s'))
            ->where('end_time', '>=', $localEnd->format('H:i:s'))
            ->exists();

        if (! $withinAvailability) {
            throw ValidationException::withMessages([
                'starts_at' => ['O psicólogo não tem disponibilidade nesse horário.'],
            ]);
        }

        $blocked = ScheduleBlock::query()
            ->where('psychologist_id', $psychologist->id)
            ->where('starts_at', '<', $endsAt)
            ->where('ends_at', '>', $startsAt)
            ->exists();

        if ($blocked) {
            throw ValidationException::withMessages([
                'starts_at' => ['Esse horário está bloqueado na agenda do psicólogo.'],
            ]);
        }

        $overlapping = Appointment::query()
            ->where('psychologist_id', $psychologist->id)
            ->where('status', '!=', Appointment::STATUS_CANCELLED)
            ->where('starts_at', '<', $endsAt)
            ->where('ends_at', '>', $startsAt)
            ->when($ignoring, fn ($query) => $query->whereKeyNot($ignoring->id))
            ->exists();

        if ($overlapping) {
            throw ValidationException::withMessages([
                'starts_at' => ['Já existe outro agendamento nesse horário para esse psicólogo.'],
            ]);
        }
    }
}
