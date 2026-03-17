<?php

namespace App\Filament\Resources\Hotels\Pages;

use App\Filament\Resources\Hotels\HotelResource;
use Doriiaan\FilamentAstrotomic\Resources\Pages\ListTranslatable;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListHotels extends ListRecords
{
    use ListTranslatable;

    protected static string $resource = HotelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
