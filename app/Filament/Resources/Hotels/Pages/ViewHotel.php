<?php

namespace App\Filament\Resources\Hotels\Pages;

use App\Filament\Resources\Hotels\HotelResource;
use Doriiaan\FilamentAstrotomic\Resources\Pages\ViewTranslatable;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewHotel extends ViewRecord
{
    use ViewTranslatable;

    protected static string $resource = HotelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
