<?php

namespace App\Filament\Resources\Offers\Pages;

use App\Filament\Resources\Offers\OfferResource;
use Doriiaan\FilamentAstrotomic\Resources\Pages\ViewTranslatable;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewOffer extends ViewRecord
{
    use ViewTranslatable;

    protected static string $resource = OfferResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
