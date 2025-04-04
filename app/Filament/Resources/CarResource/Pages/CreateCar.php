<?php

namespace App\Filament\Resources\CarResource\Pages;

use App\Filament\Resources\CarResource;
use App\Models\Car;
use DeividFortuna\Fipe\FipeCarros;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateCar extends CreateRecord
{
    protected static string $resource = CarResource::class;

    protected function getHeaderActions(): array
    {
        return [

        ];
    }

    protected function handleRecordCreation(array $data): Model
    {
        $car = FipeCarros::getVeiculo($data['brand'], $data['model'], $data['year']);

        return Car::create([
            'user_id' => auth()->user()->id,
            'brand' => $car['Marca'],
            'model' => $car['Modelo'],
            'year' => $car['AnoModelo'],
            'value' => str_replace(['R$', '.', ',00'], '', $car['Valor']),
            'fipe_code' => $car['CodigoFipe'],
        ]);
    }

    public function form(Form $form): Form
    {
        $brands = FipeCarros::getMarcas();
        $brandOptions = [];
        foreach ($brands as $brand) {
            $brandOptions[$brand['codigo']] = $brand['nome'];
        }

        return $form
            ->schema([
                Select::make('brand')
                    ->label('Marca')
                    ->searchable()
                    ->options($brandOptions)
                    ->live(),

                Select::make('model')
                    ->label('Modelo')
                    ->searchable()
                    ->hidden(fn ($get) => is_null($get('brand')))
                    ->options(function ($get) {
                        $brand = $get('brand');
                        if (! is_null($brand)) {
                            $models = FipeCarros::getModelos($brand)['modelos'];
                            $modelOptions = [];
                            foreach ($models as $model) {
                                $modelOptions[$model['codigo']] = $model['nome'];
                            }

                            return $modelOptions;
                        }

                        return [];

                    })->live(),

                Select::make('year')
                    ->label('Ano')
                    ->searchable()
                    ->hidden(fn ($get) => is_null($get('model')))
                    ->options(function ($get) {
                        $model = $get('model');
                        $brand = $get('brand');
                        if (! is_null($model)) {
                            $years = FipeCarros::getAnos($brand, $model);
                            $yearOptions = [];
                            foreach ($years as $year) {
                                $yearOptions[$year['codigo']] = $year['nome'];
                            }

                            return $yearOptions;
                        }

                        return [];
                    }),
            ]);
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
