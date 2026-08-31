<?php

namespace App\Services\Clinical;

use App\Models\Clinical\MedicalRecord;

class MedicalRecordStoreService
{
    /**
     * @param  array<string, mixed>  $data
     */
    public function execute(array $data): MedicalRecord
    {
        $medicalRecord = MedicalRecord::create($data);

        return $medicalRecord->load('patient');
    }
}
