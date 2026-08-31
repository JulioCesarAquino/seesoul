<?php

namespace App\Services\Clinical;

use App\Models\Clinical\Psychologist;

class PsychologistDestroyService
{
    public function execute(Psychologist $psychologist): void
    {
        $psychologist->delete();
    }
}
