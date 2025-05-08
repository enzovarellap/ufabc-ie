<?php

namespace App\Filament\Resources\CarResource\Pages;

use App\Filament\Resources\CarResource;
use DeividFortuna\Fipe\FipeCarros;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;

class EditCar extends EditRecord
{
    protected static string $resource = CarResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        $car = FipeCarros::getVeiculo($data['brand'], $data['model'], $data['year']);

        $record->update([
            'brand' => $car['Marca'],
            'model' => $car['Modelo'],
            'year' => $car['AnoModelo'],
            'value' => str_replace(['R$', '.', ',00'], '', $car['Valor']),
            'fipe_code' => $car['CodigoFipe'],
        ]);

        return $record;
    }
}
