<?php

namespace App\Filament\Resources\Apartments\Schemas;

use Doriiaan\FilamentAstrotomic\Schemas\Components\TranslatableTabs;
use Doriiaan\FilamentAstrotomic\TranslatableTab;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Fieldset;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

class ApartmentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('Apartment Details')
                    ->columnSpanFull()
                    ->tabs([
                        Tab::make(__('Data and Specifications'))
                            ->icon('heroicon-o-information-circle')
                            ->schema([
                                Fieldset::make(__('Basic Information'))
                                    ->schema([
                                        TranslatableTabs::make()
                                            ->localeTabSchema(fn(TranslatableTab $tab) => [
                                                TextInput::make($tab->makeName('name'))
                                                    ->required($tab->isMainLocale()),
                                                TextInput::make($tab->makeName('city'))
                                                    ->label(__('City')),
                                                Textarea::make($tab->makeName('description'))
                                                    ->required($tab->isMainLocale()),

                                                TagsInput::make($tab->makeName('tags'))
                                                    ->label(__('Features'))
                                                    ->placeholder(__('Add features like (pool, room service, free breakfast)'))
                                                    ->columnSpanFull(),
                                            ])->columnSpanFull(),
                                    ]),

                                Fieldset::make(__('Pricing'))
                                    ->columns(2)
                                    ->schema([
                                        TextInput::make('min_price')
                                            ->required()
                                            ->numeric()
                                            ->suffix('$')
                                            ->minValue(0)
                                            ->default(0)
                                            ->label(__('Min Price')),
                                        TextInput::make('max_price')
                                            ->required()
                                            ->numeric()
                                            ->suffix('$')
                                            ->minValue(0)
                                            ->default(0)
                                            ->label(__('Max Price')),
                                    ]),

                                Fieldset::make(__('Price, Rating & Status'))
                                    ->columns(3)
                                    ->schema([
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

                        Tab::make(__('Media (Images and Videos)'))
                            ->icon('heroicon-o-photo')
                            ->schema([
                                FileUpload::make('cover')
                                    ->disk('public')
                                    ->visibility('public')
                                    ->directory('apartments/covers')
                                    ->label(__('Cover'))
                                    ->image()
                                    ->columnSpanFull(),
                                FileUpload::make('images')
                                    ->disk('public')
                                    ->visibility('public')
                                    ->directory('apartments/images')
                                    ->label(__('Images'))
                                    ->multiple()
                                    ->image()
                                    ->columnSpanFull()
                                    ->preserveFilenames()
                                    ->reorderable()
                                    ->panelLayout('grid')
                                    ->helperText(__('You can upload multiple images and reorder them.')),

                                TextInput::make('video_url')
                                    ->label(__('Video URL'))
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
