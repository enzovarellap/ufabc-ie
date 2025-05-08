<?php

namespace App\Filament\Resources\CarResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class KilometersRelationManager extends RelationManager
{
    protected static string $relationship = 'kilometers';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('kilometers')
                    ->label('Kilometragem')
                    ->numeric()
                    ->minValue(0)
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('kilometers')
            ->heading('Kilometragem')
            ->columns([
                Tables\Columns\TextColumn::make('kilometers')
                    ->label('KMs')
                    ->formatStateUsing(fn(int $state) => number_format($state, 0, ',', '.')),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->modalHeading('Adicionar Kilometragem')
                    ->label('Adicionar')
                    ->icon('heroicon-o-plus'),
            ])
            ->paginated(false)
            ->actions([
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
            ]);
    }
}
