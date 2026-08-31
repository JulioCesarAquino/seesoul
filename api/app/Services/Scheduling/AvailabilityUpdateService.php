<?php

namespace App\Services\Scheduling;

use App\Models\Scheduling\Availability;

class AvailabilityUpdateService
{
    /**
     * @param  array<string, mixed>  $data
     */
    public function execute(Availability $availability, array $data): Availability
    {
        $availability->update($data);

        return $availability;
    }
}
