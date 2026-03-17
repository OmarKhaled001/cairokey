<?php

namespace App\Filament\Resources\Services\Pages;

use App\Filament\Resources\Services\ServiceResource;
use Doriiaan\FilamentAstrotomic\Resources\Pages\CreateTranslatable;
use Filament\Resources\Pages\CreateRecord;

class CreateService extends CreateRecord
{
    use CreateTranslatable;

    protected static string $resource = ServiceResource::class;
}
