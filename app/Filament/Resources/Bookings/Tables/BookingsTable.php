<?php

namespace App\Filament\Resources\Bookings\Tables;

use App\Enums\BookingStatus;
use App\Models\Apartment;
use App\Models\Car;
use App\Models\Hotel;
use App\Models\Offer;
use App\Models\Service;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\Select;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class BookingsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('client.name')
                    ->label(__('Client'))
                    ->url(fn($record): string => route('filament.admin.resources.clients.view', ['record' => $record->client]))
                    ->sortable()
                    ->searchable(),

                TextColumn::make('bookable_type')
                    ->label(__('Booking'))
                    ->formatStateUsing(function ($state) {
                        $bookableModels = [
                            Apartment::class => __('Apartment'),
                            Hotel::class     => __('Hotel'),
                            Service::class   => __('Service'),
                            Car::class       => __('Car'),
                            Offer::class     => __('Offer'),
                        ];

                        return $bookableModels[$state] ?? class_basename($state);
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

                TextColumn::make('created_at')
                    ->label(__('Created At'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->label(__('Updated At'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([])
            ->recordActions([
                ViewAction::make(),

                EditAction::make()
                    ->hidden(fn($record): bool => $record->status === BookingStatus::Completed),

                Action::make('changeStatus')
                    ->label(__('Change Status'))
                    ->icon(fn($record) => $record->status->getIcon())
                    ->color('gray')
                    ->hidden(fn($record): bool => $record->status === BookingStatus::Completed)
                    ->form([
                        Select::make('new_status')
                            ->label(__('New Status'))
                            ->options(BookingStatus::class)
                            ->required()
                            ->default(fn($record) => $record->status->value)
                            ->columnSpanFull(),
                    ])
                    ->action(function ($record, array $data) {
                        $record->update(['status' => $data['new_status']]);
                        $newStatusLabel = BookingStatus::tryFrom($data['new_status'])->getLabel() ?? __('Unknown');

                        Notification::make()
                            ->title(__('Booking status has been updated'))
                            ->body(__('Booking status updated successfully to') . " {$newStatusLabel}")
                            ->success()
                            ->send();
                    }),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
