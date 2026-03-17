<?php

namespace App\Filament\Resources\Cars\Tables;

use Filament\Tables\Table;
use Filament\Actions\Action;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TagsColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\CheckboxColumn;
use Filament\Tables\Columns\SpatieTagsColumn;

class CarsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label(__('Name'))
                    ->searchable(),
                TextColumn::make('brand')
                    ->label(__('Brand'))
                    ->badge()
                    ->color('success')
                    ->searchable(),

                TagsColumn::make('tags')
                    ->limitList(2)
                    ->label(__('Features')),
                TextColumn::make('price_per_day')
                    ->numeric()
                    ->sortable()
                    ->suffix('$')
                    ->label(__('Price')),

                IconColumn::make('active')
                    ->boolean()
                    ->label(__('Active')),
                CheckboxColumn::make('featured')
                    ->label(__('Featured')),
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
