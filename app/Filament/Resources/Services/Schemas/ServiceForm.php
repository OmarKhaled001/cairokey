<?php

namespace App\Filament\Resources\Services\Schemas;

use Doriiaan\FilamentAstrotomic\Schemas\Components\TranslatableTabs;
use Doriiaan\FilamentAstrotomic\TranslatableTab;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Fieldset;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;
use Mokhosh\FilamentRating\Components\Rating;

class ServiceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('Services Details')
                    ->columnSpanFull()
                    ->tabs([
                        Tab::make(__('Basic Information'))
                            ->icon('heroicon-o-list-bullet')
                            ->schema([
                                Fieldset::make(__('Basic Information'))
                                    ->schema([
                                        TranslatableTabs::make()
                                            ->localeTabSchema(fn(TranslatableTab $tab) => [
                                                TextInput::make($tab->makeName('name'))
                                                    ->required($tab->isMainLocale())
                                                    ->label(__('Service Title'))
                                                    ->maxLength(255),
                                                Textarea::make($tab->makeName('description'))
                                                    ->columnSpanFull()
                                                    ->label(__('Detailed service description'))
                                                    ->rows(5),
                                                TagsInput::make($tab->makeName('tags'))
                                                    ->label(__('Features'))
                                                    ->placeholder(__('Add features like (pool, room service, free breakfast)'))
                                                    ->columnSpanFull(),
                                            ])->columnSpanFull(),

                                    ])->columnSpanFull(),

                                Fieldset::make(__('Details'))
                                    ->columns(3)
                                    ->schema([
                                        TextInput::make('price')
                                            ->numeric()
                                            ->prefix('$')
                                            ->label(__('Price')),
                                        TextInput::make('icon')
                                            ->label(__('Service Icon (Class Name)'))
                                            ->helperText(__('like heroicon-o-star or fa-plane'))
                                            ->maxLength(255),

                                    ])->columnSpanFull(),

                                Fieldset::make(__('Price, Rating & Status'))
                                    ->columns(3)
                                    ->schema([
                                        Select::make('rating')
                                            ->label(__('Rating'))->options([
                                                5 => '⭐⭐⭐⭐⭐',
                                                4 => '⭐⭐⭐⭐',
                                                3 => '⭐⭐⭐',
                                                2 => '⭐⭐',
                                                1 => '⭐',
                                            ])
                                            ->native(false)
                                            ->required(),

                                        Toggle::make('active')
                                            ->required()
                                            ->default(true)
                                            ->label(__('Active')),

                                        Toggle::make('featured')
                                            ->required()
                                            ->default(false)
                                            ->label(__('Featured')),
                                    ]),
                            ]),

                        Tab::make('Media')
                            ->label(__('Media (Images and Videos)'))
                            ->icon('heroicon-o-photo')
                            ->schema([
                                FileUpload::make('cover')
                                    ->disk('public')
                                    ->visibility('public')
                                    ->directory('services/covers')
                                    ->label(__('Cover'))
                                    ->image()
                                    ->columnSpanFull(),
                                FileUpload::make('images')
                                    ->disk('public')
                                    ->visibility('public')
                                    ->directory('services/images')
                                    ->label(__('Images'))
                                    ->multiple()
                                    ->image()
                                    ->columnSpanFull()
                                    ->preserveFilenames()
                                    ->reorderable()
                                    ->panelLayout('grid')
                                    ->helperText(__('You can upload multiple images and reorder them.')),
                            ]),
                    ])
            ]);
    }
}
