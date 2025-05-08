<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CarExpenses extends Model
{
    protected $fillable = [
        'car_id',
        'category',
        'description',
        'value',
        'expense_date',
    ];

    public function car(): BelongsTo
    {
        return $this->belongsTo(Car::class);
    }

    protected function casts(): array
    {
        return [
            'expense_date' => 'date',
        ];
    }
}
