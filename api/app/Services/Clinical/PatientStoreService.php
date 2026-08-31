<?php

namespace App\Services\Clinical;

use App\Models\Clinical\Patient;
use App\Models\Clinical\Person;

class PatientStoreService
{
    public function __construct(
        private readonly PersonResolver $personResolver,
    ) {
    }

    /**
     * @param  array<string, mixed>  $data
     */
    public function execute(array $data): Patient
    {
        $person = $this->personResolver->resolve(array_intersect_key($data, array_flip(Person::fieldNames())));

        $patient = Patient::create([
            'person_id' => $person->id,
            'status' => $data['status'] ?? 'active',
        ]);

        return $patient->load('person');
    }
}
