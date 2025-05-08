<?php

namespace App\Filament\Resources\CarExpensesResource\Pages;

use App\Filament\Resources\CarExpansesResource\Widgets\CarExpansesTotalStatWidget;
use App\Filament\Resources\CarExpensesResource;
use App\Filament\Resources\CarExpensesResource\Widgets\CarExpansesPerCategoryWidget;
use App\Filament\Resources\CarExpensesResource\Widgets\CarExpensesPerMonthWidget;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCarExpenses extends ListRecords
{
    protected static string $resource = CarExpensesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Nova Despesa')
                ->icon('heroicon-s-plus')
                ->color('info'),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            CarExpansesPerCategoryWidget::make(),
            CarExpansesTotalStatWidget::make(),
        ];
    }

    protected function getFooterWidgets(): array
    {
        return [
            CarExpensesPerMonthWidget::make(),

        ];
    }
}
