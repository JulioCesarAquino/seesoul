<?php

namespace App\Services\Clinical;

use App\Models\Clinical\Specialty;

class SpecialtyUpdateService
{
    /**
     * @param  array{name: string}  $data
     */
    public function execute(Specialty $specialty, array $data): Specialty
    {
        $specialty->update($data);

        return $specialty;
    }
}
