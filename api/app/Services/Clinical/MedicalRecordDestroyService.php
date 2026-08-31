<?php

namespace App\Services\Clinical;

use App\Models\Clinical\MedicalRecord;

class MedicalRecordDestroyService
{
    public function execute(MedicalRecord $medicalRecord): void
    {
        $medicalRecord->delete();
    }
}
