<?php

namespace App\Filament\Resources\Cars\Schemas;

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

class CarForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('Car Details')
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
                                                    ->required($tab->isMainLocale())
                                                    ->label(__('Name')),
                                                TextInput::make($tab->makeName('brand'))
                                                    ->required($tab->isMainLocale())
                                                    ->label(__('Brand')),
                                                Textarea::make($tab->makeName('description'))
                                                    ->columnSpanFull()
                                                    ->label(__('Description'))
                                                    ->rows(5),

                                                TagsInput::make($tab->makeName('tags'))
                                                    ->label(__('Features'))
                                                    ->placeholder(__('Add features like (pool, room service, free breakfast)'))
                                                    ->columnSpanFull(),
                                            ])->columnSpanFull()
                                    ])->columnSpanFull(),



                                Fieldset::make(__('Price, Rating & Status'))
                                    ->columns(2)
                                    ->schema([
                                        TextInput::make('price_per_day')
                                            ->required()
                                            ->numeric()
                                            ->suffix('$')
                                            ->minValue(0)
                                            ->default(0)
                                            ->columnSpanFull()
                                            ->label(__('Price per Day')),

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

                        Tab::make(__('Media (Images)'))
                            ->icon('heroicon-o-photo')
                            ->schema([
                                FileUpload::make('cover')
                                    ->disk('public')
                                    ->visibility('public')
                                    ->directory('cars/covers')
                                    ->label(__('Cover'))
                                    ->image()
                                    ->columnSpanFull(),

                                FileUpload::make('images')
                                    ->disk('public')
                                    ->visibility('public')
                                    ->directory('cars/images')
                                    ->label(__('Images'))
                                    ->multiple()
                                    ->image()
                                    ->columnSpanFull()
                                    ->preserveFilenames()
                                    ->reorderable()
                                    ->panelLayout('grid')
                                    ->helperText(__('You can upload multiple images and reorder them.')),
                            ]),
                    ]),
            ]);
    }
}
