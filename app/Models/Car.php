<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'brand',
        'model',
        'year',
        'value',
        'fipe_code',
        'plate'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function kilometers(): HasMany
    {
        return $this->hasMany(CarKilometer::class);
    }

    public function services(): BelongsToMany
    {
        return $this->belongsToMany(Services::class, 'car_services', 'car_id', 'service_id')
            ->withPivot('timesdue', 'is_done');
    }
}
