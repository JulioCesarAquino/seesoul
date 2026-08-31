<?php

namespace App\Http\Requests\Clinical;

use App\Services\Tenancy\TenantContext;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EvolutionStoreRequest extends FormRequest
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
            'medical_record_id' => ['required', 'integer', Rule::exists('medical_records', 'id')->where('tenant_id', $tenantId)],
            'attendance_id' => ['nullable', 'integer', Rule::exists('attendances', 'id')->where('tenant_id', $tenantId)],
            'content' => ['required', 'string'],
        ];
    }
}
