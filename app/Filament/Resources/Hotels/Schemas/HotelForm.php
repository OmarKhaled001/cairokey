<?php

namespace App\Filament\Resources\Hotels\Schemas;

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

class HotelForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('Hotel Details')
                    ->columnSpanFull()
                    ->tabs([

                        Tab::make('البيانات والمواصفات')
                            ->icon('heroicon-o-information-circle')
                            ->schema([
                                Fieldset::make('المعلومات الأساسية')
                                    ->columns(3)
                                    ->schema([
                                        TextInput::make('name')
                                            ->required()
                                            ->label('اسم الفندق')
                                            ->columnSpan(2),



                                        TextInput::make('price_per_night')
                                            ->required()
                                            ->numeric()
                                            ->prefix('$')
                                            ->label('السعر لكل ليلة'),

                                        Textarea::make('description')
                                            ->columnSpanFull()
                                            ->label('الوصف التفصيلي')
                                            ->rows(5),

                                        SpatieTagsInput::make('tags')
                                            ->label('الخدمات والمميزات (Tags)')
                                            ->columnSpanFull()
                                            ->type('hotel_amenities')
                                            ->placeholder('أضف مميزات مثل (مسبح، خدمة غرف، إفطار مجاني)'),
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

                        Tab::make('الوسائط')
                            ->icon('heroicon-o-photo')
                            ->schema([
                                SpatieMediaLibraryFileUpload::make('cover')
                                    ->collection('cover')
                                    ->directory('hotels/cover')
                                    ->label('الغلاف')
                                    ->image()
                                    ->columnSpanFull()
                                    ->preserveFilenames(),

                                SpatieMediaLibraryFileUpload::make('images')
                                    ->collection('images')
                                    ->directory('hotels/images')
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
