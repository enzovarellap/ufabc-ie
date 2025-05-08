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
use Http;
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
        $car = $this->getApiData("brands/{$data['brand']}/models/{$data['model']}/years/{$data['year']}");


        $carModel = Car::create([
            'user_id' => auth()->user()->id,
            'brand' => $car['brand'],
            'model' => $car['model'],
            'year' => $car['modelYear'],
            'value' => str_replace(['R$', '.', ',00'], '', $car['price']),
            'fipe_code' => $car['codeFipe'],
            'plate' => Str::upper($data['plate']),
        ]);

        $carModel->kilometers()->create([
            'kilometers' => $data['kilometers'],
        ]);

        return $carModel;
    }

    protected function getApiData(string $endpoint): array
    {
        return Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'X-Subscription-Token' => 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VySWQiOiJiNzQ4NTA5OS00YTllLTQ1NTAtYWQzZS1iM2ExYWE1MjViNGMiLCJlbWFpbCI6ImVuem92cGFzdG9yZUBnbWFpbC5jb20iLCJpYXQiOjE3NDY2Nzg5MjN9.cGGnyGi7tc3zCnmPLYFY9vT31rG7A9Yio0pZf2y4O2Q'
        ])->baseUrl('https://fipe.parallelum.com.br/api/v2/cars/')
            ->get($endpoint)
            ->json();
    }

    protected function getBrandOptions(): array
    {
        $brands = $this->getApiData('brands');
        return collect($brands)->pluck('name', 'code')->toArray();
    }

    protected function getModelOptions($brand): array
    {
        if (!$brand) return [];
        $models = $this->getApiData("brands/{$brand}/models");
        return collect($models)->pluck('name', 'code')->toArray();
    }

    protected function getYearOptions($brand, $model): array
    {
        if (!$model || !$brand) return [];
        $years = $this->getApiData("brands/{$brand}/models/{$model}/years");
        return collect($years)->pluck('name', 'code')->toArray();
    }

    public function form(Form $form): Form
    {
        return $form->schema([
            Section::make('Selecione os campos abaixo referentes ao seu carro')
                ->schema([
                    Select::make('brand')
                        ->label('Marca')
                        ->searchable()
                        ->options($this->getBrandOptions())
                        ->live()
                        ->afterStateUpdated(function ($set) {
                            $set('year', null);
                            $set('model', null);
                        }),

                    Select::make('model')
                        ->label('Modelo')
                        ->searchable()
                        ->hidden(fn($get) => is_null($get('brand')))
                        ->options(fn($get) => $this->getModelOptions($get('brand')))
                        ->live()
                        ->afterStateUpdated(fn($set) => $set('year', null)),

                    Select::make('year')
                        ->label('Ano')
                        ->searchable()
                        ->live()
                        ->hidden(fn($get) => is_null($get('model')))
                        ->options(fn($get) => $this->getYearOptions($get('brand'), $get('model')))
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
                        ->autocapitalize('characters')
                        ->extraInputAttributes([
                            'style' => 'text-transform: uppercase',
                        ])
                ])
        ]);
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
