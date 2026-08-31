<?php

namespace App\Services\Scheduling;

use App\Models\Scheduling\Availability;

class AvailabilityDestroyService
{
    public function execute(Availability $availability): void
    {
        $availability->delete();
    }
}
