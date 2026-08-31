<?php

namespace App\Services\Clinical;

use App\Models\Clinical\Staff;

class StaffDestroyService
{
    public function execute(Staff $staff): void
    {
        $staff->delete();
    }
}
