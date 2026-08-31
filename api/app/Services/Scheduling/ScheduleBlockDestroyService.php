<?php

namespace App\Services\Scheduling;

use App\Models\Scheduling\ScheduleBlock;

class ScheduleBlockDestroyService
{
    public function execute(ScheduleBlock $scheduleBlock): void
    {
        $scheduleBlock->delete();
    }
}
