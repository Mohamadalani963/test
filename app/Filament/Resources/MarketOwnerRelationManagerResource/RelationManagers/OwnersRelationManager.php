<?php

namespace App\Filament\Resources\MarketOwnerRelationManagerResource\RelationManagers;

use App\Models\MarketOwner;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Fieldset;
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

class OwnersRelationManager extends RelationManager
{
    protected static string $relationship = 'owners';
    protected static ?string $recordTitleAttribute = 'owners'; // Adjust to your Comment field (e.g., body or title)

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('username') // Pivot field
                    ->disabledOn('edit')->rules(function()use($form){
                        if($form->getOperation()!='edit')
                            return ['unique:users,username'];
                    }),
                Forms\Components\TextInput::make('password') // Pivot field
                    ->required($form->getOperation() != "edit")
                    ->password()
                    ->confirmed(),
                Forms\Components\TextInput::make('password_confirmation') // Password confirmation field
                    ->password()
                    ->requiredWith('password'), // Ensures it's required only when password is provided
                Forms\Components\TextInput::make('first_name') // Pivot field
                    ->string()
                    ->required($form->getOperation() == "edit"),
                Forms\Components\TextInput::make('last_name') // Pivot field
                    ->string()
                    ->required($form->getOperation() == "edit"),
                Forms\Components\TextInput::make('phone_number') // Pivot field
                    ->string()
                    ->required($form->getOperation() == "edit"),
                Forms\Components\TextInput::make('id_number') // Pivot field
                    ->required($form->getOperation() == "edit"),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.username')->label('User Name'),
                Tables\Columns\TextColumn::make('first_name')->label('First Name'),
                Tables\Columns\TextColumn::make('last_name')->label('Last Name'),
                Tables\Columns\TextColumn::make('id_number')->label('id_number'),
                Tables\Columns\TextColumn::make('phone_number')->label('phone_number'),

            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->action(function (array $data) {
                        // Custom create action logic
                        // First, create the User
                        $user = User::create([
                            'username' => $data['username'],
                            'password' => $data['password'], // Handle password assignment
                        ]);
                        // Then, create the Owner linking the User to the Market
                        MarketOwner::create([
                            'user_id' => $user->id, // New User's ID
                            'market_id' => $this->ownerRecord->id, // Current Market ID
                            'first_name' => $data['first_name'],
                            'last_name' => $data['last_name'],
                            'id_number' => $data['id_number'],
                            'phone_number' => $data['phone_number']
                        ]);
                    })
                    ->modalHeading('Create Owner') // Customize the modal heading
                    ->modalButton('Create Owner') // Customize button text
                    ->mutateFormDataUsing(function (array $data) {
                        // Mutate form data before processing if needed
                        return $data;
                    })
                    ->successNotificationTitle('Owner created successfully!')
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->beforeFormFilled(function ($data, $record) {

                        // Fetch the related user
                        $user = $record->user;

                        // Fill the form fields with user data
                        $record['username'] = $user->username;
                    })
                    ->action(function (array $data, $record) {

                        if (array_key_exists('password', $data) && $data['password'])
                            // Update the User model
                            $record->user->update([
                                'password' => $data['password'], // Handle password assignment
                            ]);

                        // Update the MarketOwner model
                        $record->update([
                            'first_name' => $data['first_name'],
                            'last_name' => $data['last_name'],
                            'id_number' => $data['id_number'],
                            'phone_number' => $data['phone_number'],
                        ]);
                    })
                    ->modalHeading('Edit Owner')
                    ->modalButton('Save Changes'),
                Tables\Actions\DeleteAction::make(), // Allow deleting pivot entries
            ]);
    }
}
