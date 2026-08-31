<?php

namespace App\Services\Clinical;

use App\Models\Clinical\Specialty;

class SpecialtyStoreService
{
    /**
     * @param  array{name: string}  $data
     */
    public function execute(array $data): Specialty
    {
        return Specialty::create($data);
    }
}
