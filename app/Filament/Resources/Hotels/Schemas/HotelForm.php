<?php

namespace App\Filament\Resources\Hotels\Schemas;

use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
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



                                        TextInput::make('city')
                                            ->label('المدينة'),

                                        Textarea::make('description')
                                            ->columnSpanFull()
                                            ->label('الوصف التفصيلي')
                                            ->rows(5),

                                        TagsInput::make('tags')
                                            ->label('الخدمات والمميزات')
                                            ->columnSpanFull()
                                            ->placeholder('أضف مميزات مثل (مسبح، خدمة غرف، إفطار مجاني)'),
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
                                FileUpload::make('cover')
                                    ->disk('public')
                                    ->visibility('public')
                                    ->directory('hotels/covers')
                                    ->label('الغلاف')
                                    ->image()
                                    ->columnSpanFull(),
                            ]),
                    ]),
            ]);
    }
}
