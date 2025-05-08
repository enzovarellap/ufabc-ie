<?php

namespace App\Models;

use App\Observers\CarKilometersObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[ObservedBy([CarKilometersObserver::class])]
class CarKilometer extends Model
{
    use HasFactory;

    protected $fillable = [
        'car_id',
        'kilometers',
    ];

    public function car(): BelongsTo
    {
        return $this->belongsTo(Car::class);
    }
}
