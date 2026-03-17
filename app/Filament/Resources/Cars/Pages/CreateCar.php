<?php

namespace App\Filament\Resources\Cars\Pages;

use App\Filament\Resources\Cars\CarResource;
use Doriiaan\FilamentAstrotomic\Resources\Pages\CreateTranslatable;
use Filament\Resources\Pages\CreateRecord;

class CreateCar extends CreateRecord
{
    use CreateTranslatable;

    protected static string $resource = CarResource::class;
}
