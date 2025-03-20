<?php

namespace App\Filament\Pages;

use Filament\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Pages\Page;
use Http;

class FipeApi extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.fipe-api';
    public array $car = [];

    protected function getHeaderActions(): array
    {
        $brands = \Http::get('https://parallelum.com.br/fipe/api/v1/carros/marcas')->json();

        $brandOptions = [];
        foreach ($brands as $brand) {
            $brandOptions[$brand['codigo']] = $brand['nome'];
        }

        return [
            Action::make('search')
                ->form([
                    Select::make('brand')
                        ->searchable()
                        ->options($brandOptions)
                        ->live(),

                    Select::make('model')
                        ->searchable()
                        ->hidden(fn($get) => is_null($get('brand')))
                        ->options(function ($get) {
                            $brand = $get('brand');
                            if (!is_null($brand)) {
                                $models = \Http::get("https://parallelum.com.br/fipe/api/v1/carros/marcas/$brand/modelos")->json()['modelos'];
                                $modelOptions = [];
                                foreach ($models as $model) {
                                    $modelOptions[$model['codigo']] = $model['nome'];
                                }
                                return $modelOptions;
                            }

                            return [];

                        })->live(),

                    Select::make('year')
                        ->searchable()
                        ->hidden(fn($get) => is_null($get('model')))
                        ->options(function ($get) {
                            $model = $get('model');
                            $brand = $get('brand');
                            if (!is_null($model)) {
                                $years = \Http::get("https://parallelum.com.br/fipe/api/v1/carros/marcas/$brand/modelos/$model/anos")->json();
                                $yearOptions = [];
                                foreach ($years as $year) {
                                    $yearOptions[$year['codigo']] = $year['nome'];
                                }
                                return $yearOptions;
                            }
                            return [];
                        })

                ])->action(function($data){
                    $this->car = Http::get("https://parallelum.com.br/fipe/api/v1/carros/marcas/{$data['brand']}/modelos/{$data['model']}/anos/{$data['year']}")->json();
                })
        ];
    }
}
