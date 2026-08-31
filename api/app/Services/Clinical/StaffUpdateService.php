<?php

namespace App\Services\Clinical;

use App\Models\Clinical\Person;
use App\Models\Clinical\Staff;

class StaffUpdateService
{
    /**
     * @param  array<string, mixed>  $data
     */
    public function execute(Staff $staff, array $data): Staff
    {
        $staff->update(array_intersect_key($data, array_flip(['position', 'status'])));
        $staff->person->update(array_intersect_key($data, array_flip(Person::fieldNames())));

        return $staff->load('person');
    }
}
