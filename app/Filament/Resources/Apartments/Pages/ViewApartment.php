<?php

namespace App\Filament\Resources\Apartments\Pages;

use App\Filament\Resources\Apartments\ApartmentResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
use Doriiaan\FilamentAstrotomic\Resources\Pages\ViewTranslatable;

class ViewApartment extends ViewRecord
{
    use ViewTranslatable;
    protected static string $resource = ApartmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
