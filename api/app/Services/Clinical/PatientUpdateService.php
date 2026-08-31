<?php

namespace App\Services\Clinical;

use App\Models\Clinical\Patient;
use App\Models\Clinical\Person;

class PatientUpdateService
{
    /**
     * @param  array<string, mixed>  $data
     */
    public function execute(Patient $patient, array $data): Patient
    {
        $patient->update(array_intersect_key($data, array_flip(['status'])));
        $patient->person->update(array_intersect_key($data, array_flip(Person::fieldNames())));

        return $patient->load('person');
    }
}
