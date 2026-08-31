<?php

namespace App\Services\Clinical;

use App\Models\Clinical\Evolution;

class EvolutionUpdateService
{
    /**
     * @param  array<string, mixed>  $data
     */
    public function execute(Evolution $evolution, array $data): Evolution
    {
        $evolution->update($data);

        return $evolution->load(['medicalRecord', 'attendance', 'author']);
    }
}
