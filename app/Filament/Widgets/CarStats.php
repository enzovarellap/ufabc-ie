<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\CarResource;
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
        $pendingCarServices = $car->services()->wherePivot('is_done', false);
        $pendingCount = $pendingCarServices->count();

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

            Stat::make('Valor FIPE do Carro', \Number::currency($car->value, 'BRL', 'pt-BR'))
                ->icon('fas-money-bill-alt'),

            Stat::make('Kilometragem', number_format($carKilometers, 0, ',', '.') . ' kms')
                ->icon('fas-road')
                ->extraAttributes([
                    'class' => 'cursor-pointer',
                    'wire:click' => 'goToEdit',
                ]),

            Stat::make('Serviços Pendentes', $pendingCount)
                ->icon('heroicon-s-wrench-screwdriver')
                ->description($pendingDescription)
                ->descriptionIcon($pendingIcon)
                ->descriptionColor($pendingColor),

            Stat::make('Gasto Previsto', \Number::currency($pendingCarServices->sum('price'), 'BRL', 'pt-BR'))
                ->icon('fas-wallet'),


        ];
    }


    public function goToEdit()
    {
        $car = auth()->user()->car->first();
        if ($car) {
            return redirect(CarResource::getUrl('edit', ['record' => $car]));
        }
    }

}
