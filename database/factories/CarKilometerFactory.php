<?php

namespace Database\Factories;

use App\Models\Car;
use App\Models\CarKilometer;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class CarKilometerFactory extends Factory
{
    protected $model = CarKilometer::class;

    public function definition(): array
    {
        return [
            'kilometers' => $this->faker->randomFloat(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

            'car_id' => Car::factory(),
        ];
    }
}
