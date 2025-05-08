<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CarResource\Pages;
use App\Filament\Resources\CarResource\RelationManagers\KilometersRelationManager;
use App\Models\Car;
use DeividFortuna\Fipe\FipeCarros;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Number;

class CarResource extends Resource
{
    protected static ?string $model = Car::class;

    protected static ?string $slug = 'cars';

    protected static ?string $label = 'Carro';

    protected static ?string $pluralLabel = 'Carros';

    protected static ?string $navigationIcon = 'fas-car';

    public static function form(Form $form): Form
    {
//        $brands = FipeCarros::getMarcas();
//        $brandOptions = [];
//        foreach ($brands as $brand) {
//            $brandOptions[$brand['codigo']] = $brand['nome'];
//        }

        return $form
            ->schema([
                TextInput::make('brand')->label('Marca')->disabled(),
                TextInput::make('model')->label('Modelo')->disabled(),
                TextInput::make('year')->label('Ano')->disabled(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->query(fn() => Car::query()->where('user_id', auth()->user()->id))
            ->columns([
                TextColumn::make('brand')
                    ->label('Marca'),

                TextColumn::make('model')
                    ->label('Modelo'),

                TextColumn::make('year')
                    ->label('Ano'),

                TextColumn::make('value')
                    ->label('Valor')
                    ->formatStateUsing(fn(int $state) => Number::currency($state, 'BRL', 'pt_BR')),

                TextColumn::make('fipe_code')->label('Código Fipe'),

                TextColumn::make('plate')
                    ->label('Placa'),

                TextColumn::make('kilometers_sum_kilometers')
                    ->label('KMs')
                    ->sum('kilometers', 'kilometers')
                    ->formatStateUsing(fn(int $state) => number_format($state, '2', ',', '.') . ' kms'),
            ])
            ->filters([
                //
            ])
            ->paginated(false)
            ->actions([
                DeleteAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCars::route('/'),
            'create' => Pages\CreateCar::route('/create'),
            'edit' => Pages\EditCar::route('/{record}/edit'),
        ];
    }

    public static function getRelations(): array
    {
        return [
            KilometersRelationManager::class,
        ];
    }

    public static function getGlobalSearchEloquentQuery(): Builder
    {
        return parent::getGlobalSearchEloquentQuery()->with(['user']);
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['user.name'];
    }

    public static function getGlobalSearchResultDetails(Model $record): array
    {
        $details = [];

        if ($record->user) {
            $details['User'] = $record->user->name;
        }

        return $details;
    }
}
