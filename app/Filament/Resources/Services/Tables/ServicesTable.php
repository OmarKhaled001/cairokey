<?php

namespace App\Filament\Resources\Services\Tables;

use Filament\Tables\Table;
use Filament\Actions\Action;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\CheckboxColumn;

class ServicesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label(__('Address'))
                    ->searchable(),
                TextColumn::make('price')
                    ->label(__('Price'))
                    ->numeric()
                    ->suffix('$')
                    ->sortable(),
                CheckboxColumn::make('featured')
                    ->label(__('Featured')),
                IconColumn::make('active')
                    ->label(__('Active'))
                    ->boolean(),
            ])
            ->filters([
                //
            ])
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
