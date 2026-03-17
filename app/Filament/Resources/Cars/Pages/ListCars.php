<?php

namespace App\Filament\Resources\Cars\Pages;

use App\Filament\Resources\Cars\CarResource;
use Doriiaan\FilamentAstrotomic\Resources\Pages\ListTranslatable;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCars extends ListRecords
{
    use ListTranslatable;

    protected static string $resource = CarResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
