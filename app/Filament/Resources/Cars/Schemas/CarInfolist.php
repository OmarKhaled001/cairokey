<?php

namespace App\Filament\Resources\Cars\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class CarInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('name'),
                TextEntry::make('slug'),
                TextEntry::make('model'),
                TextEntry::make('brand'),
                TextEntry::make('year')
                    ->numeric(),
                TextEntry::make('price_per_day')
                    ->numeric(),
                TextEntry::make('transmission'),
                TextEntry::make('fuel_type'),
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
