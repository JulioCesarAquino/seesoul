<?php

namespace App\Services\Scheduling;

use App\Models\Scheduling\ScheduleBlock;
use Illuminate\Support\Carbon;

class ScheduleBlockStoreService
{
    /**
     * @param  array<string, mixed>  $data
     */
    public function execute(array $data): ScheduleBlock
    {
        $data['starts_at'] = Carbon::parse($data['starts_at'])->utc();
        $data['ends_at'] = Carbon::parse($data['ends_at'])->utc();

        return ScheduleBlock::create($data);
    }
}
