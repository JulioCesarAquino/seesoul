<?php

namespace App\Services\Clinical;

use App\Models\Clinical\Person;
use App\Models\Clinical\Psychologist;

class PsychologistUpdateService
{
    /**
     * @param  array<string, mixed>  $data
     */
    public function execute(Psychologist $psychologist, array $data): Psychologist
    {
        $psychologist->update(array_intersect_key($data, array_flip(['crp', 'default_session_price', 'status'])));
        $psychologist->person->update(array_intersect_key($data, array_flip(Person::fieldNames())));

        if (array_key_exists('specialty_ids', $data)) {
            $psychologist->specialties()->sync($data['specialty_ids']);
        }

        return $psychologist->load(['person', 'specialties']);
    }
}
