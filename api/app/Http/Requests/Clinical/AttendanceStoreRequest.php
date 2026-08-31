<?php

namespace App\Http\Requests\Clinical;

use App\Services\Tenancy\TenantContext;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AttendanceStoreRequest extends FormRequest
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
            'appointment_id' => ['required', 'integer', Rule::exists('appointments', 'id')->where('tenant_id', $tenantId)],
            'notes' => ['nullable', 'string', 'max:255'],
        ];
    }
}
