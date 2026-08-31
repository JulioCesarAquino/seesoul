<?php

namespace App\Services\Clinical;

use App\Models\Clinical\Person;
use App\Models\Clinical\Staff;

class StaffStoreService
{
    public function __construct(
        private readonly PersonResolver $personResolver,
    ) {
    }

    /**
     * @param  array<string, mixed>  $data
     */
    public function execute(array $data): Staff
    {
        $person = $this->personResolver->resolve(array_intersect_key($data, array_flip(Person::fieldNames())));

        $staff = Staff::create([
            'person_id' => $person->id,
            'position' => $data['position'],
            'status' => $data['status'] ?? 'active',
        ]);

        return $staff->load('person');
    }
}
