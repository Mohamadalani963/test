<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OfferResource\Pages;
use App\Filament\Resources\OfferResource\RelationManagers;
use App\Models\Category;
use App\Models\Market;
use App\Models\Offer;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OfferResource extends Resource
{
    protected static ?string $model = Offer::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        // ['description', 'name', 'offer_price', 'original_price', 'due_to', 'category_id', 'market_id', 'main_image']
        return $form
            ->schema([
                //
                TextInput::make('name')->required(),
                TextInput::make('description')->required(),
                TextInput::make('offer_price')->required(),
                TextInput::make('original_price')->required(),
                DatePicker::make('due_to')->required(),
                FileUpload::make('main_image')->image()->disk('public')->directory('offers'),
                Select::make('category_id')->label('Category')->options(Category::select('id','name')->pluck('name', 'id')->toArray()),
                Select::make('market_id')->label('Market')->options(Market::select('id', 'name')->pluck('name', 'id')->toArray()),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('Offer Id')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->label('Offer Name')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('description')
                    ->label('Description')
                    ->limit(50)
                    ->sortable(),

                Tables\Columns\TextColumn::make('offer_price')
                    ->label('Offer Price')
                    ->sortable(),

                Tables\Columns\TextColumn::make('original_price')
                    ->label('Original Price')
                    ->sortable(),

                Tables\Columns\TextColumn::make('due_to')
                    ->label('Due Date')
                    ->sortable(),

                // Tag column to indicate whether the offer is finished or not
                Tables\Columns\TagsColumn::make('is_finished')
                    ->label('Status')
                    ->getStateUsing(function (Offer $record) {
                        return now()->gt($record->due_to) ? ['Finished'] : ['Active'];
                    })
                    ->colors([
                        'danger' => 'Finished', // Red tag for finished offers
                        'success' => 'Active',   // Green tag for active offers
                    ]),

                Tables\Columns\TextColumn::make('category.name')
                    ->label('Category')
                    ->sortable(),

                Tables\Columns\TextColumn::make('market.name')
                    ->label('Market')
                    ->sortable(),

                Tables\Columns\ImageColumn::make('main_image')
                    ->label('Main Image')
            ])
            ->filters([
                // You can define filters if needed
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
            'index' => Pages\ListOffers::route('/'),
            'create' => Pages\CreateOffer::route('/create'),
            'edit' => Pages\EditOffer::route('/{record}/edit'),
        ];
    }
}
//TODO first add multi image to offeers
//assigning branches to offers
//show offers from the makret side
