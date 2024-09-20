<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BranchRelationManagerResource\RelationManagers\BranchRelationManager;
use App\Filament\Resources\MarketOwnerRelationManagerResource\RelationManagers\OwnersRelationManager;
use App\Filament\Resources\MarketResource\Pages;
use App\Models\Market;
use Filament\Actions\Action;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Section;

use Filament\Tables\Columns\ListColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;

use Filament\Tables\Table;

class MarketResource extends Resource
{
    protected static ?string $model = Market::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-storefront';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Market Information
                Grid::make(2)
                    ->schema([
                        // Left Side: Name and Image
                        Grid::make()
                            ->columnSpan(1)
                            ->schema([
                                TextInput::make('name')
                                    ->label('Market Name')
                                    ->required(),

                                FileUpload::make('image')
                                    ->label('Market Image')
                                    ->image()
                                    ->nullable(),
                            ]),

                        // Right Side: Contact Information (JSON)
                        Repeater::make('contact_information')
                            ->label('Contact Information')
                            ->schema([
                                Select::make('contact_type')
                                    ->label('Contact Type')
                                    ->options([
                                        'whatsapp' => 'WhatsApp',
                                        'telegram' => 'Telegram',
                                        'phone_number' => 'Phone Number',
                                        'land_line' => 'Land Line',
                                    ])
                                    ->required(),
                                TextInput::make('contact_detail')
                                    ->label('Contact Detail')
                                    ->required(),
                            ])
                            ->columns(2)
                            ->columnSpan(1)
                    ])->columns(1),
            ]);
    }
    public static function getRelations(): array
    {
        return [
            BranchRelationManager::class, // Register the relation manager
            OwnersRelationManager::class
        ];
    }
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // Market Name
                TextColumn::make('name')
                    ->label('Market Name')
                    ->sortable()
                    ->searchable(),

                // Market Image
                ImageColumn::make('image')
                    ->label('Image')
                    ->sortable()
                    ->width(50)
                    ->height(50),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }



    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMarkets::route('/'),
            'create' => Pages\CreateMarket::route('/create'),
            'edit' => Pages\EditMarket::route('/{record}/edit'),
        ];
    }
}
