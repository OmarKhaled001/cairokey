<?php

namespace App\Filament\Resources\Apartments\Pages;

use App\Filament\Resources\Apartments\ApartmentResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;
use Doriiaan\FilamentAstrotomic\Resources\Pages\EditTranslatable;

class EditApartment extends EditRecord
{
    use EditTranslatable;
    protected static string $resource = ApartmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
