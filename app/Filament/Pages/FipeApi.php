<?php

namespace App\Filament\Pages;

use DeividFortuna\Fipe\FipeCarros;
use Filament\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Pages\Page;
class FipeApi extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.fipe-api';
    public array $car = [];

    protected function getHeaderActions(): array
    {
        $brands = FipeCarros::getMarcas();
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
                        ->searchable()
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
                        })

                ])->action(function($data){
                    $this->car = FipeCarros::getVeiculo($data['brand'], $data['model'], $data['year']);
                })
        ];
    }
}
