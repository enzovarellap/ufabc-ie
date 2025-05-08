<?php

namespace App\Filament\Resources\CarExpensesResource\Widgets;

use App\ExpenseCategory;
use App\Models\CarExpenses;
use Filament\Support\RawJs;
use Filament\Widgets\ChartWidget;

class CarExpansesPerCategoryWidget extends ChartWidget
{
    protected static ?string $heading = 'Gastos por Categoria';
    protected int|string|array $columnSpan = 1;

    protected static ?string $maxHeight = '200px';


    protected function getData(): array
    {
        $expenses = CarExpenses::selectRaw('SUM(value) as total, category')
            ->groupBy('category')
            ->get();

        $labels = [];
        $totals = [];
        $colors = [];

        foreach ($expenses as $expense) {
            $labels[] = ExpenseCategory::getDescriptionFromLabel($expense->category);
            $totals[] = $expense->total;
            $colors[] = ExpenseCategory::getRgbaColorFromLabel($expense->category);
        }

        return [
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'Gastos por Categoria',
                    'data' => $totals,
                    'backgroundColor' => $colors,
                ],
            ],
        ];
    }

    protected function getOptions(): array|RawJs|null
    {
        return [
            'plugins' => [
                'legend' => [
                    'display' => true,
                ],
            ],
            'scales' => [
                'y' => [
                    'display' => false,
                ],
                'x' => [
                    'display' => false,
                ],
            ],
        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }
}
