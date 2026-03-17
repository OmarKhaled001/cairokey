<?php

namespace App\Filament\Resources\Offers\Pages;

use App\Filament\Resources\Offers\OfferResource;
use Doriiaan\FilamentAstrotomic\Resources\Pages\ListTranslatable;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListOffers extends ListRecords
{
    use ListTranslatable;

    protected static string $resource = OfferResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
