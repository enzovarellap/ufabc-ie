<?php

namespace App\Http\Controllers;

class TestController extends Controller
{
    public function __invoke()
    {
        $km = 32100;

        $maintenanceSchedule = [
            10000 => ['oil_change', 'air_filter', 'fluid_check', 'brake_check', 'alignment'],
            20000 => ['fuel_filter', 'engine_air_filter', 'suspension_check', 'battery_check'],
            30000 => ['cabin_filter', 'cooling_clean', 'spark_check', 'injector_check'],
            40000 => ['brake_fluid', 'steering_fluid', 'belt_check', 'bolt_torque'],
            // Especial: considerar 50k e 60k para revisão especial
            50000 => ['belt_replace', 'spark_replace', 'suspension_full', 'catalyst_check'],
            60000 => ['belt_replace', 'spark_replace', 'suspension_full', 'catalyst_check'],
            100000 => ['trans_fluid', 'water_pump', 'wheel_bearing', 'exhaust_check'],
        ];


        $result = [];

        foreach ($maintenanceSchedule as $interval => $codes) {
            $timesDue = intdiv($km, $interval);
            if ($timesDue > 0) {
                foreach ($codes as $code) {
                    $result[$code] = $timesDue;
                }
            }
        }

        dd($result);

    }
}
