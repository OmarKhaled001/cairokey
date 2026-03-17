<?php

namespace App\Filament\Resources\Cars\Pages;

use App\Filament\Resources\Cars\CarResource;
use Doriiaan\FilamentAstrotomic\Resources\Pages\ViewTranslatable;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewCar extends ViewRecord
{
    use ViewTranslatable;

    protected static string $resource = CarResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
