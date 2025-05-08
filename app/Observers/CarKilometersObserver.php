<?php

namespace App\Observers;

use App\Models\CarKilometer;
use App\Traits\HasServicesByKm;

class CarKilometersObserver
{
    use HasServicesByKm;

    public function created(CarKilometer $carKilometer): void
    {
        $this->addServicesToCar($carKilometer->car->id);
    }

    public function updated(CarKilometer $carKilometer): void
    {
    }

    public function deleted(CarKilometer $carKilometer): void
    {
    }

    public function restored(CarKilometer $carKilometer): void
    {
    }
}
