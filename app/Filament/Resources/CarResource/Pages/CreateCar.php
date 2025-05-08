<?php

namespace App\Filament\Resources\CarResource\Pages;

use App\Filament\Resources\CarResource;
use App\Models\Car;
use App\Traits\HasServicesByKm;
use DeividFortuna\Fipe\FipeCarros;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Pages\CreateRecord;
use Filament\Support\RawJs;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class CreateCar extends CreateRecord
{
    use HasServicesByKm;
    protected static string $resource = CarResource::class;

    protected function getHeaderActions(): array
    {
        return [

        ];
    }

    protected function handleRecordCreation(array $data): Model
    {
        $car = FipeCarros::getVeiculo($data['brand'], $data['model'], $data['year']);

        $carModel = Car::create([
            'user_id' => auth()->user()->id,
            'brand' => $car['Marca'],
            'model' => $car['Modelo'],
            'year' => $car['AnoModelo'],
            'value' => str_replace(['R$', '.', ',00'], '', $car['Valor']),
            'fipe_code' => $car['CodigoFipe'],
            'plate' => Str::upper($data['plate']),
        ]);

        $carModel->kilometers()->create([
            'kilometers' => $data['kilometers'],
        ]);

        $this->addServicesToCar($carModel->id);

        return $carModel;
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
                Section::make('Selecione os campos abaixo referentes ao seu carro')
                    ->schema([
                        Select::make('brand')
                            ->label('Marca')
                            ->searchable()
                            ->options($brandOptions)
                            ->live()
                            ->afterStateUpdated(function ($set) {
                                $set('year', null);
                                $set('model', null);
                            })->columns(),

                        Select::make('model')
                            ->label('Modelo')
                            ->searchable()
                            ->hidden(fn($get) => is_null($get('brand')))
                            ->options(function ($get) {
                                $brand = $get('brand');
                                if (!is_null($brand)) {
                                    $models = FipeCarros::getModelos($brand)['modelos'];
                                    $modelOptions = [];
                                    foreach ($models as $model) {
                                        $modelOptions[$model['codigo']] = $model['nome'];
                                    }

                                    return $modelOptions;
                                }

                                return [];

                            })->live()
                            ->afterStateUpdated(function ($set) {
                                $set('year', null);
                            })->columns(),

                        Select::make('year')
                            ->label('Ano')
                            ->searchable()
                            ->live()
                            ->hidden(fn($get) => is_null($get('model')))
                            ->options(function ($get) {
                                $model = $get('model');
                                $brand = $get('brand');
                                if (!is_null($model)) {
                                    $years = FipeCarros::getAnos($brand, $model);
                                    $yearOptions = [];
                                    foreach ($years as $year) {
                                        $yearOptions[$year['codigo']] = $year['nome'];
                                    }

                                    return $yearOptions;
                                }

                                return [];
                            })->columns(),
                    ]),

                Section::make('Adicione os dados referentes ao seu carro')
                    ->hidden(fn($get) => is_null($get('year')))
                    ->schema([
                        TextInput::make('kilometers')
                            ->label('Kilometragem')
                            ->placeholder('Adicione a kilometragem do seu carro')
                            ->numeric()
                            ->minValue(0)
                            ->required(),

                        TextInput::make('plate')
                            ->label('Placa')
                            ->validationMessages(['regex' => 'A placa deve ser no formato Brasileiro Mercosul'])
                            ->mask('aaa 9a99')
                            ->required()
                            ->placeholder('ABC 1D23')
                            ->autocapitalize('characters') // Encourages uppercase input on mobile
                            ->extraInputAttributes([
                                'style' => 'text-transform: uppercase', // Displays text in uppercase
                            ])
                    ])
            ]);
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
