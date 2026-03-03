<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Owner extends Model
{
    protected $fillable = [
        'name',
        'surname',
    ];

    public function cars() : HasMany
    {
        return $this->hasMany(Car::class, 'owner_id');
    }
}
