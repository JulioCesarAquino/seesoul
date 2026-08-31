<?php

namespace App\Http\Requests\Scheduling;

use App\Models\Scheduling\Appointment;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AppointmentUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'status' => ['sometimes', 'string', Rule::in(Appointment::STATUSES)],
            'starts_at' => ['sometimes', 'date'],
            'ends_at' => ['sometimes', 'date', 'after:starts_at', 'required_with:starts_at'],
            'notes' => ['sometimes', 'nullable', 'string'],
        ];
    }
}
