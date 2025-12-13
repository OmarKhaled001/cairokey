<?php

namespace App\Filament\Resources\Offers\Schemas;

use App\Models\Car;
use App\Models\Hotel;
use App\Models\Service;
use App\Models\Apartment;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Components\Fieldset;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;

class OfferForm
{
    private static array $bookableModels = [
        Apartment::class => 'شقة',
        Hotel::class     => 'فندق',
        Service::class   => 'خدمة',
        Car::class       => 'سيارة',
    ];

    protected static function getBookableOptions(?string $type): array
    {
        if (! $type || ! class_exists($type)) {
            return [];
        }

        return $type::query()
            ->pluck('name', 'id')
            ->toArray();
    }

    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Fieldset::make('المعلومات الأساسية والوصف')
                ->schema([
                    TextInput::make('name')
                        ->label('اسم العرض')
                        ->required()
                        ->columnSpanFull()
                        ->maxLength(255),

                    Textarea::make('description')
                        ->label('الوصف التفصيلي')
                        ->rows(3)
                        ->columnSpanFull(),
                ])
                ->columnSpanFull(),

            Fieldset::make('عناصر وكيانات العرض')
                ->schema([
                    Repeater::make('items')
                        ->label('عناصر العرض')
                        ->reactive()
                        ->schema([
                            Select::make('bookable_type')
                                ->label('نوع الكيان')
                                ->required()
                                ->options(self::$bookableModels)
                                ->reactive()
                                ->live()
                                ->afterStateUpdated(fn($state, $set) => $set('bookable_id', null)),

                            Select::make('bookable_id')
                                ->label('الكيان المرتبط')
                                ->required()
                                ->options(fn($get) => self::getBookableOptions($get('bookable_type')))
                                ->searchable()
                                ->reactive()
                                ->live(),

                            TextInput::make('days')
                                ->label('عدد الأيام/الليالي')
                                ->numeric()
                                ->required()
                                ->default(1)
                                ->minValue(1)
                                ->reactive()
                                ->live(),
                        ])
                        ->minItems(1)
                        ->columns(3)
                        ->defaultItems(1)
                        ->afterStateUpdated(fn($state, $set, $get) => self::updateOriginalPrice($get, $set))
                        ->columnSpanFull(),
                ])
                ->columnSpanFull(),

            Fieldset::make('السعر والمدة')
                ->schema([
                    TextInput::make('price')
                        ->label('السعر الجديد')
                        ->required()
                        ->numeric()
                        ->prefix('$'),

                    TextInput::make('original_price')
                        ->label('السعر الأصلي')
                        ->numeric()
                        ->readOnly()
                        ->default(0)
                        ->prefix('$'),

                    DatePicker::make('start_date')
                        ->label('تاريخ بداية العرض')
                        ->required()
                        ->default(now())
                        ->reactive()
                        ->live()
                        ->afterStateUpdated(fn($state, $set, $get) => self::updateOriginalPrice($get, $set)),

                    DatePicker::make('end_date')
                        ->label('تاريخ نهاية العرض')
                        ->required()
                        ->afterOrEqual('start_date')
                        ->default(now()->addDays(7))
                        ->reactive()
                        ->live()
                        ->afterStateUpdated(fn($state, $set, $get) => self::updateOriginalPrice($get, $set)),
                ])
                ->columnSpanFull(),

            Fieldset::make('حالة العرض')
                ->schema([
                    Toggle::make('active')
                        ->label('نشط')
                        ->required()
                        ->default(true),

                    Toggle::make('featured')
                        ->label('مميز')
                        ->required()
                        ->default(false),
                ])
                ->columnSpanFull(),

            FileUpload::make('cover')
                ->disk('public')
                ->visibility('public')
                ->directory('offers/covers')
                ->label('الغلاف')
                ->image()
                ->columnSpanFull(),
        ]);
    }

    protected static function updateOriginalPrice(callable $get, callable $set): void
    {
        $items = $get('items') ?? [];
        $totalOriginalPrice = 0;

        if (! is_array($items) || empty($items)) {
            $set('original_price', 0);
            return;
        }

        foreach ($items as $item) {
            $type = $item['bookable_type'] ?? null;
            $id   = $item['bookable_id'] ?? null;
            $days = max(1, (int)($item['days'] ?? 1));

            if (! ($type && $id)) {
                continue;
            }

            if (! class_exists($type)) {
                continue;
            }

            $model = $type::find($id);
            if (! $model) {
                continue;
            }

            $price = 0;
            $multiplier = 0;

            if (is_a($model, Apartment::class) || is_a($model, Hotel::class)) {
                $price = $model->price_per_night ?? 0;
                $multiplier = $days;
            } elseif (is_a($model, Car::class)) {
                $price = $model->price_per_day ?? 0;
                $multiplier = $days;
            } elseif (is_a($model, Service::class)) {
                $price = $model->price ?? 0;
                $multiplier = 1;
            }

            $totalOriginalPrice += max(0, $price * $multiplier);
        }

        $set('original_price', $totalOriginalPrice);
    }
}
