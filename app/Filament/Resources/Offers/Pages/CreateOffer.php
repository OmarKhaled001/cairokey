<?php

namespace App\Filament\Resources\Offers\Pages;

use App\Filament\Resources\Offers\OfferResource;
use Doriiaan\FilamentAstrotomic\Resources\Pages\CreateTranslatable;
use Filament\Resources\Pages\CreateRecord;

class CreateOffer extends CreateRecord
{
    use CreateTranslatable;

    protected static string $resource = OfferResource::class;
}
