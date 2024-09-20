<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DistrictResource\Pages;
use App\Filament\Resources\DistrictResource\RelationManagers;
use App\Models\District;
use Filament\Forms;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\CheckboxColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DistrictResource extends Resource
{
    protected static ?string $model = District::class;

    protected static ?string $navigationIcon = 'heroicon-s-map-pin';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->required(),
                TextInput::make('lat')->required()->rules(['decimal:0,4']),
                TextInput::make('lng')->required()->rules(['decimal:0,4']),
                Select::make('city')
                    ->required()
                    ->label('City')
                    ->options([
                        'Damascus' => 'Damascus',
                        'Aleepo' => 'Aleepo',
                        'Lattakia' => 'Lattakia',
                        'Tartus' => 'Tartus',
                        'Daraa' => 'Daraa',
                        'Sweida' => 'Sweida',
                        'Homs' => 'Homs',
                        'Deir Al Zor' => 'Deir Al Zor',
                        'Al Raqqa' => 'Al Raqqa',
                        'Al Qamishli' => 'Al Qamishli',
                        'Hama' => 'Hama',
                        'Idlib' => 'Idlib',
                        'Rif Dimshq' => 'Rif Dimshq',
                    ])
                    ->default('Damascus')
                    ->rules(['required', 'in:Damascus,Aleepo,Lattakia,Tartus,Daraa,Sweida,Homs,Deir Al Zor,Al Raqqa,Al Qamishli,Hama,Idlib,Rif Dimshq']),

                Checkbox::make('status')
                    ->label('Active')
                    ->default(true),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id'),
                TextColumn::make('name'),
                TextColumn::make('lat'),
                TextColumn::make('lng'),
                TextColumn::make('city'),
                CheckboxColumn::make('status')
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDistricts::route('/'),
            'create' => Pages\CreateDistrict::route('/create'),
            'edit' => Pages\EditDistrict::route('/{record}/edit'),
        ];
    }
}
