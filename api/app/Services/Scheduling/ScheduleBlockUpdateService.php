<?php

namespace App\Services\Scheduling;

use App\Models\Scheduling\ScheduleBlock;
use Illuminate\Support\Carbon;

class ScheduleBlockUpdateService
{
    /**
     * @param  array<string, mixed>  $data
     */
    public function execute(ScheduleBlock $scheduleBlock, array $data): ScheduleBlock
    {
        if (isset($data['starts_at'])) {
            $data['starts_at'] = Carbon::parse($data['starts_at'])->utc();
        }

        if (isset($data['ends_at'])) {
            $data['ends_at'] = Carbon::parse($data['ends_at'])->utc();
        }

        $scheduleBlock->update($data);

        return $scheduleBlock;
    }
}
