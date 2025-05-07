<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Services extends Model
{
    protected $fillable = [
        'label',
        'name',
        'price',
    ];

    public function cars(): BelongsToMany
    {
        return $this->belongsToMany(Car::class, 'car_services', 'service_id', 'car_id')
            ->withPivot('timesdue', 'is_done');
    }
}
