<?php

namespace App\Services\Clinical;

use App\Models\Clinical\Person;
use App\Models\Clinical\Psychologist;

class PsychologistStoreService
{
    public function __construct(
        private readonly PersonResolver $personResolver,
    ) {
    }

    /**
     * @param  array<string, mixed>  $data
     */
    public function execute(array $data): Psychologist
    {
        $person = $this->personResolver->resolve(array_intersect_key($data, array_flip(Person::fieldNames())));

        $psychologist = Psychologist::create([
            'person_id' => $person->id,
            'crp' => $data['crp'],
            'default_session_price' => $data['default_session_price'] ?? null,
            'status' => $data['status'] ?? 'active',
        ]);

        $psychologist->specialties()->sync($data['specialty_ids'] ?? []);

        return $psychologist->load(['person', 'specialties']);
    }
}
