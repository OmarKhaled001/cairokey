<?php

namespace App\Filament\Resources\Hotels\Pages;

use App\Filament\Resources\Hotels\HotelResource;
use Doriiaan\FilamentAstrotomic\Resources\Pages\CreateTranslatable;
use Filament\Resources\Pages\CreateRecord;

class CreateHotel extends CreateRecord
{
    use CreateTranslatable;

    protected static string $resource = HotelResource::class;
}
