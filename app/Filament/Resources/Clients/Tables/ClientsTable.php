<?php

namespace App\Filament\Resources\Clients\Tables;

use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ClientsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('avatar')
                    ->label(__('Image'))
                    ->circular(),
                TextColumn::make('name')
                    ->label(__('Name'))
                    ->searchable(),
                TextColumn::make('email')
                    ->label(__('Email'))
                    ->searchable(),
                TextColumn::make('phone')
                    ->label(__('Phone'))
                    ->searchable(),
                IconColumn::make('active')
                    ->boolean()
                    ->label(__('Status')),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->label(__('Registration Date'))
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->label(__('Updated At'))
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
