<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class CarStats extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $car = auth()->user()->car->first();
        if (is_null($car)) {
            return [];
        }

        $carKilometers = $car->kilometers->sum('kilometers');
        $pendingCount = $car->services()->wherePivot('is_done', false)->count();

        if ($pendingCount === 0) {
            $pendingDescription = 'Tudo certo!';
            $pendingIcon = 'heroicon-s-check';
            $pendingColor = 'success';
        } elseif ($pendingCount >= 1 && $pendingCount < 10) {
            $pendingDescription = 'Alguns Serviços Pendentes';
            $pendingIcon = 'heroicon-s-exclamation-circle';
            $pendingColor = 'warning';
        } elseif ($pendingCount >= 10) {
            $pendingDescription = 'Diversos Serviços Pendentes';
            $pendingIcon = 'heroicon-s-exclamation-circle';
            $pendingColor = 'danger';
        }

        return [
            Stat::make('Meu Carro', $car->brand . ' - ' . $car->model)
                ->icon('fas-car')
                ->description('Ano: ' . $car->year . ' | Placa: ' . $car->plate),

            Stat::make('Kilometragem', number_format($carKilometers, 0, ',', '.') . ' kms')
                ->icon('fas-road'),

            Stat::make('Serviços Pendentes', $pendingCount)
                ->icon('heroicon-s-wrench-screwdriver')
                ->description($pendingDescription)
                ->descriptionIcon($pendingIcon)
                ->descriptionColor($pendingColor),

            Stat::make('Valor Total', \Number::currency($car->value, 'BRL', 'pt-BR'))
                ->icon('fas-money-bill-alt'),
        ];
    }
}
