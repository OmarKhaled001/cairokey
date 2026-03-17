<?php

namespace App\Filament\Resources\Services;

use App\Filament\Resources\Services\Pages\CreateService;
use App\Filament\Resources\Services\Pages\EditService;
use App\Filament\Resources\Services\Pages\ListServices;
use App\Filament\Resources\Services\Pages\ViewService;
use App\Filament\Resources\Services\Schemas\ServiceForm;
use App\Filament\Resources\Services\Schemas\ServiceInfolist;
use App\Filament\Resources\Services\Tables\ServicesTable;
use App\Models\Service;
use BackedEnum;
use Doriiaan\FilamentAstrotomic\Resources\Concerns\ResourceTranslatable;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ServiceResource extends Resource
{
    use ResourceTranslatable;

    protected static ?string $model = Service::class;
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleGroup;
    protected static ?int $navigationSort = 4;

    public static function getNavigationLabel(): string
    {
        return __('Services');
    }
    public static function getModelLabel(): string
    {
        return __('Service');
    }
    public static function getPluralModelLabel(): string
    {
        return __('Services');
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
        return ServiceForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ServiceInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ServicesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListServices::route('/'),
            'create' => CreateService::route('/create'),
            'view' => ViewService::route('/{record}'),
            'edit' => EditService::route('/{record}/edit'),
        ];
    }
}
