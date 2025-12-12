<?php

namespace App\Filament\Resources\Clients\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;

class ClientForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('الاسم')
                    ->required(),
                TextInput::make('email')
                    ->label('البريد الالكتروني')
                    ->email(),
                TextInput::make('phone')
                    ->label('رقم الهاتف')
                    ->tel(),
                Toggle::make('active')
                    ->label('الحالة')
                    ->required(),
            ]);
    }
}
