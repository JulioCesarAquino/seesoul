<?php

namespace App\Services\Clinical;

use App\Models\Clinical\Evolution;

class EvolutionStoreService
{
    /**
     * @param  array<string, mixed>  $data
     */
    public function execute(array $data, int $authorUserId): Evolution
    {
        $evolution = Evolution::create([
            ...$data,
            'author_user_id' => $authorUserId,
        ]);

        return $evolution->load(['medicalRecord', 'attendance', 'author']);
    }
}
