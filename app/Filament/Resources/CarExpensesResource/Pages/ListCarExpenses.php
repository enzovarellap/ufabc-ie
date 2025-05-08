<?php

namespace App\Filament\Resources\CarExpensesResource\Pages;

use App\Filament\Resources\CarExpensesResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCarExpenses extends ListRecords
{
    protected static string $resource = CarExpensesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
