<?php

namespace App\Filament\Resources\Offers\Pages;

use App\Filament\Resources\Offers\OfferResource;
use Doriiaan\FilamentAstrotomic\Resources\Pages\EditTranslatable;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditOffer extends EditRecord
{
    use EditTranslatable;

    protected static string $resource = OfferResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
