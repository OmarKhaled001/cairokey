<?php

namespace App\Filament\Resources\Offers;

use App\Filament\Resources\Offers\Pages\CreateOffer;
use App\Filament\Resources\Offers\Pages\EditOffer;
use App\Filament\Resources\Offers\Pages\ListOffers;
use App\Filament\Resources\Offers\Pages\ViewOffer;
use App\Filament\Resources\Offers\Schemas\OfferForm;
use App\Filament\Resources\Offers\Schemas\OfferInfolist;
use App\Filament\Resources\Offers\Tables\OffersTable;
use App\Models\Offer;
use BackedEnum;
use Doriiaan\FilamentAstrotomic\Resources\Concerns\ResourceTranslatable;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class OfferResource extends Resource
{
    use ResourceTranslatable;

    protected static ?string $model = Offer::class;
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedFire;
    protected static ?int $navigationSort = 5;

    public static function getNavigationLabel(): string
    {
        return __('Offers');
    }
    public static function getModelLabel(): string
    {
        return __('Offer');
    }
    public static function getPluralModelLabel(): string
    {
        return __('Offers');
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
        return OfferForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return OfferInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return OffersTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListOffers::route('/'),
            'create' => CreateOffer::route('/create'),
            'view' => ViewOffer::route('/{record}'),
            'edit' => EditOffer::route('/{record}/edit'),
        ];
    }
}
