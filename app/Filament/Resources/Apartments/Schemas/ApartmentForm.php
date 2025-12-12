<?php

namespace App\Filament\Resources\Apartments\Schemas;

use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Tabs;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Fieldset;
use Filament\Schemas\Components\Tabs\Tab;
use Mokhosh\FilamentRating\Components\Rating;
use Filament\Forms\Components\SpatieTagsInput;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;

class ApartmentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('Apartment Details')
                    ->columnSpanFull()
                    ->tabs([
                        Tab::make('Basic Info & Specifications')
                            ->label('البيانات والمواصفات')
                            ->icon('heroicon-o-information-circle')
                            ->schema([
                                Fieldset::make('معلومات أساسية')
                                    ->schema([
                                        TextInput::make('name')
                                            ->required()
                                            ->columnSpanFull()
                                            ->label('الاسم'),

                                        Textarea::make('description')
                                            ->columnSpanFull()
                                            ->label('الوصف')
                                            ->rows(5),
                                        SpatieTagsInput::make('tags')
                                            ->type('features')
                                            ->label('المميزات')
                                            ->columnSpanFull(),
                                    ]),

                                Fieldset::make('الموقع الجغرافي')
                                    ->schema([
                                        TextInput::make('governorate')
                                            ->label('المحافظة'),

                                        TextInput::make('city')
                                            ->label('المدينة'),

                                        TextInput::make('address')
                                            ->label('العنوان التفصيلي'),

                                        TextInput::make('location')
                                            ->suffixIcon(Heroicon::OutlinedVideoCamera)
                                            ->label('الموقع (رابط الخريطة)'),
                                    ]),

                                Fieldset::make('المواصفات المالية والعددية')
                                    ->columns(2)
                                    ->schema([
                                        TextInput::make('rooms')
                                            ->required()
                                            ->numeric()
                                            ->minValue(0)
                                            ->default(0)
                                            ->label('عدد الغرف'),

                                        TextInput::make('price_per_night')
                                            ->required()
                                            ->numeric()
                                            ->suffix('$')
                                            ->minValue(0)
                                            ->default(0)
                                            ->label('السعر لكل ليلة'),
                                    ]),

                                Fieldset::make('الحالة والتقييم')
                                    ->columns(3)
                                    ->schema([
                                        Rating::make('rating')
                                            ->required()
                                            ->color('info')
                                            ->default(5)
                                            ->label('التقييم'),

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

                        Tab::make('Media')
                            ->label('الوسائط (صور وفيديوهات)')
                            ->icon('heroicon-o-photo')
                            ->schema([
                                SpatieMediaLibraryFileUpload::make('cover')
                                    ->collection('cover')
                                    ->directory('apartments/cover')
                                    ->label('الغلاف')
                                    ->image()
                                    ->columnSpanFull()
                                    ->preserveFilenames(),

                                SpatieMediaLibraryFileUpload::make('images')
                                    ->collection('images')
                                    ->directory('apartments/images')
                                    ->label('الصور')
                                    ->multiple()
                                    ->image()
                                    ->columnSpanFull()
                                    ->preserveFilenames()
                                    ->reorderable()
                                    ->panelLayout('grid')
                                    ->helperText('يمكنك تحميل صور متعددة وإعادة ترتيبها.'),

                                TextInput::make('video_url')
                                    ->label('رابط الفيديو')
                                    ->placeholder('https://www.youtube.com/watch?v')
                                    ->url()
                                    ->columnSpanFull()
                                    ->suffixIcon(Heroicon::OutlinedVideoCamera)
                                    ->required(),

                            ]),
                    ]),
            ]);
    }
}
