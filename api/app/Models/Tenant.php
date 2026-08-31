<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tenant extends Model
{
    protected $fillable = [
        'name',
        'subdomain',
        'status',
    ];

    /**
     * Users belonging to this tenant.
     *
     * @return BelongsToMany<User, $this>
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'tenant_users')->withTimestamps();
    }
}
