<?php

namespace App\Http\Requests\Clinical;

use App\Services\Tenancy\TenantContext;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MedicalRecordStoreRequest extends FormRequest
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
            'patient_id' => [
                'required',
                'integer',
                Rule::exists('patients', 'id')->where('tenant_id', $tenantId),
                Rule::unique('medical_records', 'patient_id')->where('tenant_id', $tenantId)->whereNull('deleted_at'),
            ],
        ];
    }
}
