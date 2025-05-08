<?php

namespace App\Filament\Resources\CarExpensesResource\Widgets;

use App\Models\CarExpenses;
use Filament\Widgets\ChartWidget;

class CarExpensesPerMonthWidget extends ChartWidget
{
    protected static ?string $heading = 'Total de Gastos por Mês';

    protected int | string | array $columnSpan = 'full';

    protected function getData(): array
    {
        // Mapeamento dos meses em português
        $monthsMap = [
            1 => 'Janeiro', 2 => 'Fevereiro', 3 => 'Março',
            4 => 'Abril', 5 => 'Maio', 6 => 'Junho',
            7 => 'Julho', 8 => 'Agosto', 9 => 'Setembro',
            10 => 'Outubro', 11 => 'Novembro', 12 => 'Dezembro'
        ];

        $expenses = CarExpenses::query()
            ->where('car_id', auth()->user()->car->first()->id)
            ->selectRaw('SUM(value) as total, MONTH(expense_date) as month')
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $months = [];
        $totals = [];

        foreach ($expenses as $expense) {
            $months[] = $monthsMap[$expense->month];
            $totals[] = $expense->total;
        }

        return [
            'labels' => $months,
            'datasets' => [
                [
                    'label' => 'Total Gasto (R$)',
                    'data' => $totals,
                    'backgroundColor' => 'rgba(54, 162, 235, 0.6)',
                    'borderWidth' => 0, // Remove as linhas do gráfico
                ],
            ],
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
