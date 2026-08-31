<?php

namespace App\Services\Clinical;

use App\Models\Clinical\Specialty;

class SpecialtyDestroyService
{
    public function execute(Specialty $specialty): void
    {
        $specialty->delete();
    }
}
