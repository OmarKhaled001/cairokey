<?php

namespace App\Filament\Resources\Offers\Schemas;

use App\Models\Car;
use App\Models\Hotel;
use App\Models\Service;
use App\Models\Apartment;
use Doriiaan\FilamentAstrotomic\Schemas\Components\TranslatableTabs;
use Doriiaan\FilamentAstrotomic\TranslatableTab;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Fieldset;
use Filament\Schemas\Schema;

class OfferForm
{
    /**
     * List of bookable models
     */
    private static function getBookableModels(): array
    {
        return [
            Apartment::class => __('Apartment'),
            Hotel::class     => __('Hotel'),
            Service::class   => __('Service'),
            Car::class       => __('Car'),
        ];
    }

    /**
     * Get dynamic options for the given bookable type
     */
    protected static function getBookableOptions(?string $type): array
    {
        if (!$type || !class_exists($type)) {
            return [];
        }

        $model = new $type;

        // إذا كان الموديل يدعم الترجمة (Astrotomic)
        if (in_array('Astrotomic\Translatable\Translatable', class_uses_recursive($model))) {
            return $type::query()
                ->where('active', true)
                ->get()
                ->mapWithKeys(function ($item) {
                    // بيحاول يجيب الاسم باللغة الحالية، لو مفيش بيجيب الإنجليزي، لو مفيش بيجيب أول ترجمة متاحة
                    return [$item->id => $item->translate(app()->getLocale())?->name
                        ?? $item->translate('en')?->name
                        ?? $item->translations->first()?->name];
                })
                ->toArray();
        }

        // fallback للنماذج غير قابلة للترجمة
        return $type::query()
            ->where('active', true)
            ->pluck('name', 'id')
            ->toArray();
    }
    /**
     * Configure the Filament Offer Schema
     */
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            // ─── Basic Info ─────────────────────────
            Fieldset::make(__('Basic Information'))
                ->schema([
                    TranslatableTabs::make()
                        ->localeTabSchema(fn(TranslatableTab $tab) => [
                            TextInput::make($tab->makeName('name'))
                                ->required($tab->isMainLocale())
                                ->label(__('Offer Name'))
                                ->maxLength(255),
                            Textarea::make($tab->makeName('description'))
                                ->label(__('Detailed Description'))
                                ->rows(3),
                        ])
                        ->columnSpanFull(),
                ])
                ->columnSpanFull(),

            // ─── Offer Items ─────────────────────────
            Fieldset::make(__('Offer Items and Entities'))
                ->schema([
                    Repeater::make('items')
                        ->label(__('Offer Items'))
                        ->reactive()
                        ->schema([
                            Select::make('bookable_type')
                                ->label(__('Entity Type'))
                                ->required()
                                ->options(self::getBookableModels())
                                ->reactive()
                                ->live()
                                ->afterStateUpdated(fn($state, $set) => $set('bookable_id', null)),

                            Select::make('bookable_id')
                                ->label(__('Related Entity'))
                                ->required()
                                ->options(fn($get) => self::getBookableOptions($get('bookable_type')))
                                ->searchable()
                                ->reactive()
                                ->live(),

                            TextInput::make('days')
                                ->label(__('Days/Nights Count'))
                                ->numeric()
                                ->required()
                                ->default(1)
                                ->minValue(1)
                                ->reactive()
                                ->live(),
                        ])
                        ->minItems(1)
                        ->defaultItems(1)
                        ->columns(3)
                        ->columnSpanFull(),
                ])
                ->columnSpanFull(),

            // ─── Price & Duration ───────────────────
            Fieldset::make(__('Price & Duration'))
                ->schema([
                    TextInput::make('price')
                        ->label(__('New Price'))
                        ->required()
                        ->numeric()
                        ->minValue(0)
                        ->prefix('$'),

                    TextInput::make('original_price')
                        ->label(__('Original Price'))
                        ->numeric()
                        ->minValue(0)
                        ->default(0)
                        ->prefix('$'),

                    DatePicker::make('start_date')
                        ->label(__('Offer Start Date'))
                        ->required()
                        ->default(now())
                        ->reactive(),

                    DatePicker::make('end_date')
                        ->label(__('Offer End Date'))
                        ->required()
                        ->afterOrEqual('start_date')
                        ->default(now()->addDays(7)),
                ])
                ->columnSpanFull(),

            // ─── Status ─────────────────────────────
            Fieldset::make(__('Offer Status'))
                ->schema([
                    Toggle::make('active')
                        ->label(__('Active'))
                        ->required()
                        ->default(true),

                    Toggle::make('featured')
                        ->label(__('Featured'))
                        ->required()
                        ->default(false),
                ])
                ->columnSpanFull(),

            // ─── Cover Image ────────────────────────
            FileUpload::make('cover')
                ->disk('public')
                ->directory('offers/covers')
                ->label(__('Cover'))
                ->image()
                ->columnSpanFull(),
        ]);
    }
}
