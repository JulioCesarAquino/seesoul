<?php

namespace App\Services\Clinical;

use App\Models\Clinical\Person;

class PersonResolver
{
    /**
     * Find an existing Person by CPF or create a new one.
     *
     * @param  array<string, mixed>  $data
     */
    public function resolve(array $data): Person
    {
        if (! empty($data['cpf'])) {
            $person = Person::where('cpf', $data['cpf'])->first();

            if ($person) {
                return $person;
            }
        }

        return Person::create($data);
    }
}
