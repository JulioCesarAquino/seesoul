<?php

namespace App\Models\Clinical;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Specialty extends Model
{
    protected $fillable = [
        'name',
    ];

    /**
     * @return BelongsToMany<Psychologist, $this>
     */
    public function psychologists(): BelongsToMany
    {
        return $this->belongsToMany(Psychologist::class)->withTimestamps();
    }
}
