<?php

namespace App\Filament\Resources\Hotels\Schemas;

use App\Filament\Forms\Components\RatingSelect;
use Doriiaan\FilamentAstrotomic\Schemas\Components\TranslatableTabs;
use Doriiaan\FilamentAstrotomic\TranslatableTab;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\ViewField;
use Filament\Schemas\Components\Fieldset;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;
use Mokhosh\FilamentRating\Components\Rating;


class HotelForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('Hotel Details')
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
                                                    ->label(__('Hotel Name')),
                                                TextInput::make($tab->makeName('city'))
                                                    ->label(__('City')),
                                                Textarea::make($tab->makeName('description'))
                                                    ->label(__('Detailed Description'))
                                                    ->rows(5),

                                                TagsInput::make($tab->makeName('tags'))
                                                    ->label(__('Features'))
                                                    ->placeholder(__('Add features like (pool, room service, free breakfast)'))
                                                    ->columnSpanFull(),
                                            ])->columnSpanFull(),
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

                        Tab::make(__('Media'))
                            ->icon('heroicon-o-photo')
                            ->schema([
                                FileUpload::make('cover')
                                    ->disk('public')
                                    ->visibility('public')
                                    ->directory('hotels/covers')
                                    ->label(__('Cover'))
                                    ->image()
                                    ->columnSpanFull(),
                                FileUpload::make('images')
                                    ->disk('public')
                                    ->visibility('public')
                                    ->directory('hotels/images')
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
