<?php

namespace App\Services\Clinical;

use App\Models\Clinical\Evolution;

class EvolutionDestroyService
{
    public function execute(Evolution $evolution): void
    {
        $evolution->delete();
    }
}
