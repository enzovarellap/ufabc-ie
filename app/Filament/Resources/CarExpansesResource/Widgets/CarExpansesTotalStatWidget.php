<?php

namespace App\Filament\Resources\CarExpansesResource\Widgets;

use App\Models\CarExpenses;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class CarExpansesTotalStatWidget extends BaseWidget
{
    protected int|string|array $columnSpan = 1;

    protected function getStats(): array
    {
        $carExpenses = auth()->user()->car->first()?->expenses();
        if ($carExpenses) {
            $expensesTotal = $carExpenses->sum('value');
            $expensesCount = $carExpenses->count();

            return [
                Stat::make('Total de Gastos', \Number::currency($expensesTotal, 'BRL', 'pt-BR')),
                Stat::make('Quantidade de Despesas', $expensesCount )
            ];
        }

        return [

        ];


    }

    protected function getColumns(): int
    {
        return 1;
    }
}
