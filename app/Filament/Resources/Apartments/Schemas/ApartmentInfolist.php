<?php

namespace App\Filament\Resources\Apartments\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ApartmentInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('name'),
                TextEntry::make('slug'),
                TextEntry::make('governorate'),
                TextEntry::make('city'),
                TextEntry::make('address'),
                TextEntry::make('location'),
                TextEntry::make('rooms')
                    ->numeric(),
                TextEntry::make('beds')
                    ->numeric(),
                TextEntry::make('price_per_night')
                    ->numeric(),
                TextEntry::make('rating')
                    ->numeric(),
                IconEntry::make('active')
                    ->boolean(),
                IconEntry::make('featured')
                    ->boolean(),
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
            ]);
    }
}
