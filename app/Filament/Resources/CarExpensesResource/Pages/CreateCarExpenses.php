<?php

namespace App\Filament\Resources\CarExpensesResource\Pages;

use App\Filament\Resources\CarExpensesResource;
use App\Models\CarExpenses;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateCarExpenses extends CreateRecord
{
    protected static string $resource = CarExpensesResource::class;

    protected function getHeaderActions(): array
    {
        return [

        ];
    }

    protected function handleRecordCreation(array $data): Model
    {
       $carId = auth()->user()->car->first()->id;
       $data['car_id'] = $carId;

       return CarExpenses::create($data);
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
