<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class CarInfoWidget extends BaseWidget
{
    protected function getStats(): array
    {
        $car = auth()->user()->car->first();
        if (is_null($car)) {
            return [];
        }

        return [
            Stat::make('Meu Carro', $car->brand . ' - ' . $car->model)
                ->icon('fas-car')
                ->description('Ano: ' . $car->year . ' | Placa: ' . $car->plate),
        ];
    }

    protected function getColumns(): int
    {
        return 1;
    }

    public function getColumnSpan(): int|string|array
    {
        return 1;
    }
}
