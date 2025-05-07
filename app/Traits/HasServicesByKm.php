<?php

namespace App\Traits;

use App\Models\Car;
use App\Models\Services;

trait HasServicesByKm
{
    public function addServicesToCar(int $carId): array
    {
        $car = Car::find($carId);

        $km = (int)$car->kilometers->sum('kilometers');

        $services = Services::all();

        $maintenanceSchedule = [
            10000 => ['oil_change', 'air_filter', 'fluid_check', 'brake_check', 'alignment'],
            20000 => ['fuel_filter', 'engine_air_filter', 'suspension_check', 'battery_check'],
            30000 => ['cabin_filter', 'cooling_clean', 'spark_check', 'injector_check'],
            40000 => ['brake_fluid', 'steering_fluid', 'belt_check', 'bolt_torque'],
            50000 => ['belt_replace', 'spark_replace', 'suspension_full', 'catalyst_check'],
            60000 => ['belt_replace', 'spark_replace', 'suspension_full', 'catalyst_check'],
            100000 => ['trans_fluid', 'water_pump', 'wheel_bearing', 'exhaust_check'],
        ];

        $servicesToAttach = [];

        foreach ($maintenanceSchedule as $interval => $codes) {
            $timesDue = intdiv($km, $interval);
            if ($timesDue > 0) {
                foreach ($codes as $code) {
                    $service = $services->firstWhere('label', $code);
                    if ($service) {
                        // Check if the service is already attached to the car
                        $existingPivot = $car->services()
                            ->wherePivot('service_id', $service->id)
                            ->first();

                        // Attach if:
                        // - The service is not attached (new service)
                        // - The service has been marked as done and the new timesdue is greater
                        if (!$existingPivot || ($existingPivot->pivot->is_done && $timesDue > $existingPivot->pivot->timesdue)) {
                            $servicesToAttach[$service->id] = ['timesdue' => $timesDue, 'is_done' => false];
                        }
                    }
                }
            }
        }

        if ($servicesToAttach) {
            $car->services()->attach($servicesToAttach);
        }

        return $servicesToAttach;
    }
}
