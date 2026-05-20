<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Owner extends Model
{
    protected $fillable = [
        'name',
        'surname',
        'user_id',
    ];

    public function cars() : HasMany
    {
        return $this->hasMany(Car::class, 'owner_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
