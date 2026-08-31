<?php

namespace App\Services\Scheduling;

use App\Models\Scheduling\Availability;

class AvailabilityStoreService
{
    /**
     * @param  array<string, mixed>  $data
     */
    public function execute(array $data): Availability
    {
        return Availability::create($data);
    }
}
