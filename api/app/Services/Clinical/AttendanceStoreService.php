<?php

namespace App\Services\Clinical;

use App\Models\Clinical\Attendance;
use App\Models\Scheduling\Appointment;
use Illuminate\Validation\ValidationException;

class AttendanceStoreService
{
    /**
     * @param  array<string, mixed>  $data
     */
    public function execute(array $data): Attendance
    {
        $appointment = Appointment::findOrFail($data['appointment_id']);

        if ($appointment->status !== Appointment::STATUS_COMPLETED) {
            throw ValidationException::withMessages([
                'appointment_id' => ['Só é possível registrar o atendimento de um agendamento já marcado como realizado.'],
            ]);
        }

        if (Attendance::where('appointment_id', $appointment->id)->exists()) {
            throw ValidationException::withMessages([
                'appointment_id' => ['Já existe um atendimento registrado para esse agendamento.'],
            ]);
        }

        $attendance = Attendance::create([
            'appointment_id' => $appointment->id,
            'patient_id' => $appointment->patient_id,
            'psychologist_id' => $appointment->psychologist_id,
            'occurred_at' => $appointment->starts_at,
            'notes' => $data['notes'] ?? null,
        ]);

        return $attendance->load(['appointment', 'patient', 'psychologist']);
    }
}
