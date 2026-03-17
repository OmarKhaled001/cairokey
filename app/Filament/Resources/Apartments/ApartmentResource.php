<?php

namespace App\Filament\Resources\Apartments;

use App\Filament\Resources\Apartments\Pages\CreateApartment;
use App\Filament\Resources\Apartments\Pages\EditApartment;
use App\Filament\Resources\Apartments\Pages\ListApartments;
use App\Filament\Resources\Apartments\Pages\ViewApartment;
use App\Filament\Resources\Apartments\Schemas\ApartmentForm;
use App\Filament\Resources\Apartments\Schemas\ApartmentInfolist;
use App\Filament\Resources\Apartments\Tables\ApartmentsTable;
use App\Models\Apartment;
use BackedEnum;
use Doriiaan\FilamentAstrotomic\Resources\Concerns\ResourceTranslatable;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ApartmentResource extends Resource
{
    use ResourceTranslatable;

    protected static ?string $model = Apartment::class;
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedHomeModern;
    protected static ?int $navigationSort = 2;

    public static function getNavigationLabel(): string
    {
        return __('Apartments');
    }
    public static function getModelLabel(): string
    {
        return __('Apartment');
    }
    public static function getPluralModelLabel(): string
    {
        return __('Apartments');
    }
    public static function getNavigationGroup(): ?string
    {
        return __('Asset Management');
    }

    public static function getTranslatableLocales(): array
    {
        return ['ar', 'en'];
    }

    public static function form(Schema $schema): Schema
    {
        return ApartmentForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ApartmentInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ApartmentsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListApartments::route('/'),
            'create' => CreateApartment::route('/create'),
            'view' => ViewApartment::route('/{record}'),
            'edit' => EditApartment::route('/{record}/edit'),
        ];
    }
}
