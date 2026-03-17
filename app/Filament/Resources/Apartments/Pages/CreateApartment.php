<?php

namespace App\Filament\Resources\Apartments\Pages;

use App\Filament\Resources\Apartments\ApartmentResource;
use Filament\Resources\Pages\CreateRecord;
use Doriiaan\FilamentAstrotomic\Resources\Pages\CreateTranslatable;

class CreateApartment extends CreateRecord
{
    use CreateTranslatable;
    protected static string $resource = ApartmentResource::class;
}
