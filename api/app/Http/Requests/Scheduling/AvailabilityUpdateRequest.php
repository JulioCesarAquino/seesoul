<?php

namespace App\Http\Requests\Scheduling;

use App\Services\Tenancy\TenantContext;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AvailabilityUpdateRequest extends FormRequest
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
            'psychologist_id' => ['sometimes', 'integer', Rule::exists('psychologists', 'id')->where('tenant_id', $tenantId)],
            'weekday' => ['sometimes', 'integer', 'between:0,6'],
            'start_time' => ['sometimes', 'date_format:H:i'],
            'end_time' => ['sometimes', 'date_format:H:i', 'after:start_time'],
        ];
    }
}
