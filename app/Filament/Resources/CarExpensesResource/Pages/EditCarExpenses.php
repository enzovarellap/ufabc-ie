<?php

namespace App\Filament\Resources\CarExpensesResource\Pages;

use App\Filament\Resources\CarExpensesResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditCarExpenses extends EditRecord
{
    protected static string $resource = CarExpensesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
