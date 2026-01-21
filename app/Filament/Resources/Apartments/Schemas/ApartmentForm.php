<?php

namespace App\Filament\Resources\Apartments\Schemas;

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
                                            ->label('الاسم'),
                                        TextInput::make('city')
                                            ->label('المدينة'),
                                        Textarea::make('description')
                                            ->columnSpanFull()
                                            ->required()
                                            ->label('الوصف')
                                            ->rows(5),
                                        TagsInput::make('tags')
                                            ->label('المميزات')
                                            ->required()
                                            ->columnSpanFull(),
                                    ]),

                                Fieldset::make('المواصفات المالية والعددية')
                                    ->columns(2)
                                    ->schema([
                                        TextInput::make('min_price')
                                            ->required()
                                            ->numeric()
                                            ->suffix('$')
                                            ->minValue(0)
                                            ->default(0)
                                            ->label('السعر الأدنى'),
                                        TextInput::make('max_price')
                                            ->required()
                                            ->numeric()
                                            ->suffix('$')
                                            ->minValue(0)
                                            ->default(0)
                                            ->label('السعر الأقصى'),
                                    ]),

                                Fieldset::make('الحالة والتقييم')
                                    ->columns(3)
                                    ->schema([
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
                                FileUpload::make('cover')
                                    ->disk('public')
                                    ->visibility('public')
                                    ->directory('apartments/covers')
                                    ->label('الغلاف')
                                    ->image()
                                    ->columnSpanFull(),
                                FileUpload::make('images')
                                    ->disk('public')
                                    ->visibility('public')
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
                                    ->nullable()
                                    ->suffixIcon(Heroicon::OutlinedVideoCamera),

                            ]),
                    ]),
            ]);
    }
}
