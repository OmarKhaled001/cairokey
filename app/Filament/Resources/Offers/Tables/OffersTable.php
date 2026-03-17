<?php

namespace App\Filament\Resources\Offers\Tables;

use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\CheckboxColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class OffersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label(__('Offer Name'))
                    ->searchable(),

                TextColumn::make('original_price')
                    ->label(__('Original Price'))
                    ->numeric()
                    ->sortable()
                    ->badge()
                    ->color('danger')
                    ->suffix('$'),

                TextColumn::make('price')
                    ->label(__('Price'))
                    ->numeric()
                    ->sortable()
                    ->suffix('$')
                    ->badge()
                    ->color('success'),

                TextColumn::make('start_date')
                    ->label(__('Start Date'))
                    ->date()
                    ->sortable(),

                TextColumn::make('end_date')
                    ->label(__('End Date'))
                    ->date()
                    ->sortable(),

                CheckboxColumn::make('featured')
                    ->label(__('Featured')),

                IconColumn::make('active')
                    ->label(__('Active'))
                    ->boolean(),
            ])
            ->filters([])
            ->recordActions([
                Action::make('toggleActive')
                    ->label(fn($record) => $record->active ? __('Disable') : __('Enable'))
                    ->icon(fn($record) => $record->active ? 'heroicon-o-x-circle' : 'heroicon-o-check-circle')
                    ->color(fn($record) => $record->active ? 'danger' : 'success')
                    ->requiresConfirmation()
                    ->action(function ($record) {
                        $record->active = !$record->active;
                        $record->save();
                    }),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
