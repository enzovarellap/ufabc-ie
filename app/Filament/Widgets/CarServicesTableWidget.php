<?php

namespace App\Filament\Widgets;

use App\Models\Car;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Collection;

class CarServicesTableWidget extends BaseWidget
{
    protected static ?int $sort = 2;
    protected int|string|array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->relationship(fn(): BelongsToMany => auth()->user()->car()->first()->services())
            ->heading('Serviços Necessários')
            ->bulkActions([
                Tables\Actions\BulkAction::make('concluir')
                    ->icon('heroicon-o-check')
                    ->color('success')
                    ->action(function (Collection $records) {
                        $car = auth()->user()->car->first();
                        if (!$car) {
                            return;
                        }

                        foreach ($records as $record) {
                            $car->services()->updateExistingPivot($record->id, ['is_done' => true]);
                        }
                    })->deselectRecordsAfterCompletion()
            ])
            ->checkIfRecordIsSelectableUsing(
                fn(Model $record): bool => ! $record->is_done,
            )
            ->actions([
                Tables\Actions\Action::make('concluir')
                    ->icon('heroicon-s-check')
                    ->color('success')
                    ->tooltip('Concluir')
                    ->iconButton()
                    ->action(function ($record) {
                        $car = Car::find($record->car_id);
                        if (!$car) {
                            return;
                        }

                        $car->services()->updateExistingPivot($record->id, ['is_done' => true]);
                    })->hidden(fn($record): bool => $record->is_done),

                Tables\Actions\Action::make('reverter')
                    ->icon('heroicon-s-x-circle')
                    ->color('danger')
                    ->tooltip('Voltar para pendente')
                    ->iconButton()
                    ->action(function ($record) {
                        $car = Car::find($record->car_id);
                        if (!$car) {
                            return;
                        }

                        $car->services()->updateExistingPivot($record->id, ['is_done' => false]);
                    })->hidden(fn($record): bool => !$record->is_done),
            ])
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nome'),

                Tables\Columns\TextColumn::make('price')
                    ->label('Preço')
                    ->alignCenter()
                    ->money('BRL'),

                Tables\Columns\IconColumn::make('is_done')
                    ->boolean()
                    ->label('Pendente')
                    ->alignCenter(),

            ])->filters([
                Tables\Filters\TernaryFilter::make('is_done')
                    ->label('Serviços Pendentes')
                    ->placeholder('Todos')
                    ->default(false)
            ]);
    }
}
