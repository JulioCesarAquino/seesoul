<?php

namespace App\Http\Requests\Clinical;

use App\Models\Clinical\Person;
use Illuminate\Foundation\Http\FormRequest;

class StaffUpdateRequest extends FormRequest
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
            'position' => ['sometimes', 'string', 'max:255'],
            'status' => ['sometimes', 'string', 'in:active,inactive'],
        ];
    }
}
