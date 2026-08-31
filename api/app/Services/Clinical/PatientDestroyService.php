<?php

namespace App\Services\Clinical;

use App\Models\Clinical\Patient;

class PatientDestroyService
{
    public function execute(Patient $patient): void
    {
        $patient->delete();
    }
}
