<?php

namespace App\Filament\App\Pages\Auth;

use Filament\Facades\Filament;
use Filament\Forms\Components\Component;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\Auth\Login;
use Illuminate\Contracts\Support\Htmlable;

class CustomLogin extends Login
{

    public function mount(): void
    {
        if (Filament::auth()->check()) {
            redirect()->intended(Filament::getUrl());
        }

        if (app()->environment('local')) {
            $this->form->fill([
                'username' => 'admin',
                'password' => 'password',
            ]);
            error_log('test');
        }
    }

    protected function getCredentialsFromFormData(array $data): array
    {
        return [
            'username' => $data['username'],
            'password' => $data['password'],
        ];
    }

    public function getTitle(): string|Htmlable
    {
        return __('Admin Login');
    }

    public function getHeading(): string|Htmlable
    {
        return __('Admin Login');
    }

    protected function getEmailFormComponent(): Component
    {
        return TextInput::make('username')
            ->label('Username')
            ->required()
            ->autofocus()
            ->extraInputAttributes(['tabindex' => 1])
            ->autocomplete();
    }
}
