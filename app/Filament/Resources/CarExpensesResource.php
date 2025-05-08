<?php

namespace App\Filament\Resources;

use App\ExpenseCategory;
use App\Filament\Resources\CarExpensesResource\Pages;
use App\Models\CarExpenses;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class CarExpensesResource extends Resource
{
    protected static ?string $model = CarExpenses::class;

    protected static ?string $slug = 'car-expenses';

    protected static ?string $label = 'Despesa';

    protected static ?string $navigationIcon = 'fas-wallet';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('category')
                    ->label('Categoria')
                    ->options(ExpenseCategory::toArray())
                    ->required(),

                TextInput::make('description')
                    ->label('Descrição')
                    ->placeholder('Breve descrição da despesa')
                    ->maxLength(255)
                    ->required(),

                TextInput::make('value')
                    ->label('Valor')
                    ->required()
                    ->label('Valor')
                    ->prefix('R$')
                    ->numeric()
                    ->extraAttributes(['step' => '0.01']),

                DatePicker::make('expense_date')
                    ->default(now())
                    ->native(false)
                    ->label('Data da Despesa'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('category')
                    ->label('Categoria')
                    ->formatStateUsing(fn(string $state): string => ExpenseCategory::getDescriptionFromLabel($state))
                    ->badge()
                    ->color(fn(string $state): string => ExpenseCategory::getColorFromLabel($state))
                    ->icon(fn(string $state): string => ExpenseCategory::getIconFromLabel($state)),

                TextColumn::make('description')
                    ->searchable()
                    ->label('Descrição'),

                TextColumn::make('value')
                    ->label('Valor')
                    ->sortable()
                    ->money('BRL'),

                TextColumn::make('expense_date')
                    ->label('Data da Despesa')
                    ->sortable()
                    ->date('d/m/Y'),
            ])
            ->filters([
                SelectFilter::make('category')
                    ->options(ExpenseCategory::toArray())
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCarExpenses::route('/'),
            'create' => Pages\CreateCarExpenses::route('/create'),
            'edit' => Pages\EditCarExpenses::route('/{record}/edit'),
        ];
    }

    public static function getGloballySearchableAttributes(): array
    {
        return [];
    }
}
