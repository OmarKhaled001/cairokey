<?php

namespace App\Filament\Resources\Services\Schemas;

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
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;

class ServiceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('Services Details')
                    ->columnSpanFull()
                    ->tabs([
                        Tab::make('البيانات الأساسية')
                            ->icon('heroicon-o-list-bullet')
                            ->schema([
                                Fieldset::make('معلومات الخدمة')
                                    ->columns(3)
                                    ->schema([
                                        TextInput::make('name')
                                            ->required()
                                            ->label('عنوان الخدمة')
                                            ->maxLength(255)
                                            ->columnSpan(2),



                                        TextInput::make('price')
                                            ->numeric()
                                            ->prefix('$')
                                            ->label('السعر'),
                                        TextInput::make('icon')
                                            ->label('أيقونة الخدمة (اسم الكلاس)')
                                            ->helperText('مثل heroicon-o-star أو fa-plane')
                                            ->maxLength(255)
                                            ->columnSpanFull(),

                                        Textarea::make('description')
                                            ->columnSpanFull()
                                            ->label('الوصف التفصيلي للخدمة')
                                            ->rows(5),
                                        TagsInput::make('tags')
                                            ->label('المميزات')
                                            ->columnSpanFull(),
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
                                FileUpload::make('cover')
                                    ->disk('public')
                                    ->visibility('public')
                                    ->directory('services/covers')
                                    ->label('الغلاف')
                                    ->image()
                                    ->columnSpanFull(),


                            ]),
                    ])
            ]);
    }
}
