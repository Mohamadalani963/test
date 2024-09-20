<?php

namespace App\Filament\Resources\BranchRelationManagerResource\RelationManagers;

use App\Models\Branch;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BranchRelationManager extends RelationManager
{
    protected static string $relationship = 'branch';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make(2)
                    ->schema([
                        TextInput::make('name')
                            ->label('Branch Name')
                            ->required(),

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
                            ->rule(['sometimes']),

                        TextInput::make('address')
                            ->label('Branch Address')
                            ->required(),

                        TextInput::make('lat')
                            ->label('Latitude')
                            ->numeric()
                            ->nullable(),

                        TextInput::make('lng')
                            ->label('Longitude')
                            ->numeric()
                            ->nullable(),

                        Select::make('district_id')
                            ->label('District')
                            ->relationship('district', 'name')
                            ->required(),
                    ])
                    ->columns(1)
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Branch Name')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('address')
                    ->label('Address'),

                TextColumn::make('lat')
                    ->label('Latitude'),

                TextColumn::make('lng')
                    ->label('Longitude'),

                TextColumn::make('district.name')
                    ->label('District'),
            ])
            ->filters([
                // Add any filters if needed
            ])
            ->actions([
                Tables\Actions\EditAction::make()->beforeFormFilled(function ($data, $record) {
                    if (isset($record['contact_information'])) {
                        $record['contact_information'] = collect($record['contact_information'])
                            ->map(function ($value, $key) {
                                return [
                                    'contact_type' => $key,
                                    'contact_detail' => $value,
                                ];
                            })
                            ->values()
                            ->toArray();
                    }
                })->action(function ($data, $record): void {
                    // Transform the contact_information array into a key-value JSON object
                    $data['contact_information'] = collect($data['contact_information'])
                        ->mapWithKeys(function ($item) {
                            return [$item['contact_type'] => $item['contact_detail']];
                        })
                        ->toArray();
                    $record->update($data);
                }),
                Tables\Actions\DeleteAction::make(),
            ])->headerActions([
                Tables\Actions\CreateAction::make()->action(function (array $data) {
                    $data['contact_information'] = collect($data['contact_information'])
                        ->mapWithKeys(function ($item) {
                            return [$item['contact_type'] => $item['contact_detail']];
                        })
                        ->toArray();
                    $data['market_id'] = $this->ownerRecord->id;
                    Branch::create($data);
                })
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
}
