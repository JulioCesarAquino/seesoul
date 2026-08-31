<?php

namespace App\Http\Requests\Clinical;

use App\Models\Clinical\Person;
use Illuminate\Foundation\Http\FormRequest;

class PatientUpdateRequest extends FormRequest
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
            'status' => ['sometimes', 'string', 'in:active,inactive'],
        ];
    }
}
