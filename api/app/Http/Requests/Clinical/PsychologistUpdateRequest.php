<?php

namespace App\Http\Requests\Clinical;

use App\Models\Clinical\Person;
use Illuminate\Foundation\Http\FormRequest;

class PsychologistUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, array<int, string>>
     */
    public function rules(): array
    {
        return [
            ...Person::rules(partial: true),
            'crp' => ['sometimes', 'string', 'max:20'],
            'default_session_price' => ['nullable', 'numeric', 'min:0'],
            'status' => ['sometimes', 'string', 'in:active,inactive'],
            'specialty_ids' => ['sometimes', 'array'],
            'specialty_ids.*' => ['integer', 'exists:specialties,id'],
        ];
    }
}
