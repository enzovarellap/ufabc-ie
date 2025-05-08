<?php

namespace App\Filament\Widgets;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class CarServicesTableWidget extends BaseWidget
{
    protected static ?int $sort = 2;
    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(function () {
                $car = auth()->user()->car->first();
                if (is_null($car)) {
                    return null;
                }

                return $car->services();
            })
            ->heading('Serviços Necessários')
            ->bulkActions([
                Tables\Actions\BulkAction::make('test')
                    ->action(function ($records) {
                        dd($records);
                    })
            ])
            ->actions([
                Tables\Actions\Action::make('test')
                ->action(function ($record) {
                    dd($record);
                })
            ])
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nome'),

                Tables\Columns\TextColumn::make('price')
                    ->label('Preço')
                    ->money('BRL'),

                Tables\Columns\IconColumn::make('is_done')
                    ->boolean()
                    ->label('Realizado?'),

            ])->filters([
                Tables\Filters\TernaryFilter::make('is_done')
                    ->label('Serviços Realizados')
                    ->placeholder('Todos')
                    ->default(false)
            ]);
    }
}
