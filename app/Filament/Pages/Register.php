<?php

namespace App\Filament\Pages;

use Filament\Http\Responses\Auth\Contracts\RegistrationResponse;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Pages\Auth\Register as BaseRegister;

class Register extends BaseRegister
{
    public function form(Form $form): Form
    {
        return $form
        ->schema([
            TextInput::make('name')
            ->label('Name')
            ->required(),
        TextInput::make('username')
            ->label('Username')
            ->required()
            ->maxLength(255)
            ->unique(Author::class),
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
            ->dehydrated('false'),
        FileUpload::make('avatar')
            ->label('Avatar')
            ->image()
            ->required()
            ->disk('public')
            ->directory('avatars'),
        Textarea::make('bio')
            ->label('Bio')
            ->password()
            ->required()
            ->maxLength(1000)
            ->rows('3'),
        ])->statePath('Data');;
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
                'role' => 'author'
            ]);

            //create author record with user_id relationship
            $author = Author::create([
                'user_id' => $user->id,
                'username' => $data['username'],
                'avatar' => $data['avatar'],
                'bio' => $data['bio'],
            ]);

            event(new Registered($user));

            $this->form->fill();

            Notification::make()
                ->title('Registrasi berhasil')
                ->succes()
                ->send();
            return app(RegistrationResponse::class);
    }
}
