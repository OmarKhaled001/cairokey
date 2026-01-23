<?php

namespace App\Filament\Resources\Cars\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Tabs;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Components\Fieldset;
use Filament\Schemas\Components\Tabs\Tab;
use Mokhosh\FilamentRating\Components\Rating;
use Filament\Forms\Components\SpatieTagsInput;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;

class CarForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('Car Details')
                    ->columnSpanFull()
                    ->tabs([

                        /* ------------------------------------
                     * 🟦 TAB 1 — Basic Info
                     * ------------------------------------ */
                        Tab::make('Basic Info & Specifications')
                            ->label('البيانات والمواصفات')
                            ->icon('heroicon-o-information-circle')
                            ->schema([

                                /* ------------------ *
                             * Basic Info
                             * ------------------ */
                                Fieldset::make('معلومات أساسية')
                                    ->schema([
                                        TextInput::make('name')
                                            ->required()
                                            ->label('الاسم'),
                                        TextInput::make('brand')
                                            ->required()
                                            ->label('العلامة التجارية'),
                                        Textarea::make('description')
                                            ->columnSpanFull()
                                            ->label('الوصف')
                                            ->rows(5),
                                        TagsInput::make('tags')
                                            ->label('المميزات')
                                            ->columnSpanFull(),
                                    ]),


                                /* ------------------ *
                             * Pricing
                             * ------------------ */
                                Fieldset::make('السعر والتقييم والحالة')
                                    ->columns(2)
                                    ->schema([
                                        TextInput::make('price_per_day')
                                            ->required()
                                            ->numeric()
                                            ->suffix('$')
                                            ->minValue(0)
                                            ->default(0)
                                            ->columnSpanFull()
                                            ->label('السعر لليوم'),

                                        Toggle::make('active')
                                            ->required()
                                            ->default(true)
                                            ->label('نشط'),

                                        Toggle::make('featured')
                                            ->required()
                                            ->default(false)
                                            ->label('مميز'),
                                    ]),
                            ]),

                        /* ------------------------------------
                     * 🟩 TAB 2 — Media
                     * ------------------------------------ */
                        Tab::make('Media')
                            ->label('الوسائط (صور)')
                            ->icon('heroicon-o-photo')
                            ->schema([
                                FileUpload::make('cover')
                                    ->disk('public')
                                    ->visibility('public')
                                    ->directory('cars/covers')
                                    ->label('الغلاف')
                                    ->image()
                                    ->columnSpanFull(),

                                FileUpload::make('images')
                                    ->disk('public')
                                    ->visibility('public')
                                    ->directory('cars/images')
                                    ->label('الصور')
                                    ->multiple()
                                    ->image()
                                    ->columnSpanFull()
                                    ->preserveFilenames()
                                    ->reorderable()
                                    ->panelLayout('grid')
                                    ->helperText('يمكنك تحميل صور متعددة وإعادة ترتيبها.'),
                            ]),
                    ]),
            ]);
    }
}
