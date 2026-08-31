<?php

namespace App\Http\Requests\Scheduling;

use App\Services\Tenancy\TenantContext;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AppointmentStoreRequest extends FormRequest
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
        $tenantId = app(TenantContext::class)->id();

        return [
            'psychologist_id' => ['required', 'integer', Rule::exists('psychologists', 'id')->where('tenant_id', $tenantId)],
            'patient_id' => ['required', 'integer', Rule::exists('patients', 'id')->where('tenant_id', $tenantId)],
            'starts_at' => ['required', 'date'],
            'ends_at' => ['required', 'date', 'after:starts_at'],
            'notes' => ['nullable', 'string'],
        ];
    }
}
