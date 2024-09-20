<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ParamResource\Pages;
use App\Models\Param;
use Filament\Forms;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Field;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ParamResource extends Resource
{
    protected static ?string $model = Param::class;

    protected static ?string $navigationIcon = 'heroicon-s-cog-8-tooth';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->required()->disabled(),
                TextInput::make('type')->required()->disabled(),
                TextInput::make('value')
                    ->label('Value')
                    ->visible(fn($get) => $get('type') === 'string'),
                TextInput::make('value')
                    ->label('Value')
                    ->numeric()
                    ->visible(fn($get) => $get('type') === 'integer'),
                Checkbox::make('value')
                    ->label('Value')
                    ->visible(fn($get) => $get('type') === 'bool'),
            ]);
    }
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label('Name'),
                TextColumn::make('value')->label('Value'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([]),
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
            'index' => Pages\ListParams::route('/'),
            'edit' => Pages\EditParam::route('/{record}/edit'),
            // 'create' => Pages\CreateParam::route('/create'), // Remove or comment out this line to disable Create operation
        ];
    }
}
