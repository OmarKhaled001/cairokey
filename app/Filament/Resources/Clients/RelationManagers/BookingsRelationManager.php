<?php

namespace App\Filament\Resources\Clients\RelationManagers;

use App\Models\Car;
use App\Models\Hotel;
use App\Models\Offer;
use App\Models\Service;
use App\Models\Apartment;
use Filament\Tables\Table;
use Filament\Schemas\Schema;
use Filament\Actions\EditAction;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\AssociateAction;
use Filament\Actions\BulkActionGroup;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DissociateAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Forms\Components\DatePicker;
use Filament\Actions\DissociateBulkAction;
use Filament\Resources\RelationManagers\RelationManager;

class BookingsRelationManager extends RelationManager
{
    protected static string $relationship = 'bookings';
    public static function getTitle(\Illuminate\Database\Eloquent\Model $ownerRecord, string $pageClass): string { return __('Bookings'); }
    public static function getModelLabel(): string { return __('Book'); }
    public static function getPluralModelLabel(): string { return __('Bookings'); }
    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('type')
                    ->label(__('Type of Booking'))
                    ->options([
                        'apartment' => __('Apartment'),
                        'hotel' => __('Hotel'),
                        'car' => __('Car'),
                    ])
                    ->required(),

                TextInput::make('price')
                    ->label(__('Price'))
                    ->numeric()
                    ->required(),

                DatePicker::make('start_date')
                    ->label(__('Date From'))
                    ->required(),

                DatePicker::make('end_date')
                    ->label(__('Date To'))
                    ->required(),

                Toggle::make('active')
                    ->label(__('Active'))
                    ->default(true),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('type')
            ->columns([

                TextColumn::make('bookable_type')
                    ->label(__('Booking'))
                    ->formatStateUsing(function ($state, $record) {
                        $bookableModels = [
                            Apartment::class => __('Apartment'),
                            Hotel::class     => __('Hotel'),
                            Service::class   => __('Service'),
                            Car::class       => __('Car'),
                            Offer::class     => __('Offer'),
                        ];

                        $typeLabel = $bookableModels[$state] ?? class_basename($state);

                        return "{$typeLabel}";
                    })
                    ->tooltip(fn($record): string => "{$record->bookable?->name}")
                    ->searchable()
                    ->badge()
                    ->color('info')
                    ->sortable(),

                TextColumn::make('start_date')
                    ->label(__('Date From'))
                    ->date()
                    ->sortable(),

                TextColumn::make('end_date')
                    ->label(__('Date To'))
                    ->date()
                    ->sortable(),

                TextColumn::make('total_price')
                    ->label(__('Total'))
                    ->numeric()
                    ->suffix(' $')
                    ->badge()
                    ->color('success')
                    ->sortable(),

                TextColumn::make('status')
                    ->label(__('Status'))
                    ->badge()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                CreateAction::make(),
                AssociateAction::make(),
            ])
            ->recordActions([
                EditAction::make(),
                DissociateAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DissociateBulkAction::make(),
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
