<?php

namespace App\Filament\Resources\Clients\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ClientForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label(__('Name'))
                    ->required(),
                TextInput::make('email')
                    ->label(__('Email'))
                    ->email(),
                TextInput::make('phone')
                    ->label(__('Phone'))
                    ->tel(),
                Toggle::make('active')
                    ->label(__('Status'))
                    ->required(),
            ]);
    }
}
