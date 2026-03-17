<?php

namespace App\Filament\Resources\Apartments\Pages;

use App\Filament\Resources\Apartments\ApartmentResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Doriiaan\FilamentAstrotomic\Resources\Pages\ListTranslatable;

class ListApartments extends ListRecords
{
    use ListTranslatable;
    protected static string $resource = ApartmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
