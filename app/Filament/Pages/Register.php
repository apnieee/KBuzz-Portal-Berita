<?php

namespace App\Filament\Pages;

use App\Models\User;
use App\Models\Author;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Filament\Notifications\Notification;
use DanHarrin\LivewireRateLimiting\Exceptions\TooManyRequestsException;
use Filament\Http\Responses\Auth\Contracts\RegistrationResponse;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Pages\Page;
use Filament\Pages\Auth\Register as BaseRegister;

class Register extends BaseRegister
{
    public ?array $data = [];
    public function form(Form $form): Form
    {
        return $form
        ->schema([
            TextInput::make('name')
            ->label('Name')
            ->required(),
        TextInput::make('email')
            ->label('Email')
            ->email()
            ->required()
            ->maxLength(255)
            ->unique(User::class),
        TextInput::make('password')
            ->label('Password')
            ->password()
            ->required()
            ->maxLength(8)
            ->same('passwordConfirmation'),
        TextInput::make('passwordConfirmation')
            ->label('Konfirmasi Password')
            ->password()
            ->required()
            ->maxLength(8)
            ->dehydrated(false),
        ])->statePath('data');
    }

    public function register(): ?RegistrationResponse
    {
        try{
            $this->rateLimit(5);
        } catch (TooManyRequestsException $exception) {
            Notification::make()
                ->title('Terlalu banyak percobaan')
                ->body('Silakan coba lagi dalam ' . $exception->secondsUntilAvailable . 'detik')
                ->danger()
                ->send();

            return null;
        }

        $data =$this->form->getState();

            //create user record first
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make ($data['password']),
                'role' => 'user'
            ]);

            event(new Registered($user));

            $this->form->fill();

            Notification::make()
                ->title('Registrasi berhasil')
                ->success()
                ->send();
            return app(RegistrationResponse::class);
    }
}
