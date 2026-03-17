<?php

namespace App\Filament\Resources\Apartments\Tables;

use Filament\Tables\Table;
use Filament\Actions\Action;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Support\Icons\Heroicon;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TagsColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\CheckboxColumn;
use Filament\Tables\Columns\SpatieTagsColumn;
use Hugomyb\FilamentMediaAction\Actions\MediaAction;
use Tapp\FilamentSocialShare\Actions\SocialShareAction;

class ApartmentsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable(query: fn (\Illuminate\Database\Eloquent\Builder $query, string $search) => $query->whereTranslationLike('name', "%{$search}%"))
                    ->label(__('Name')),

                TextColumn::make('city')
                    ->searchable(query: fn (\Illuminate\Database\Eloquent\Builder $query, string $search) => $query->whereTranslationLike('city', "%{$search}%"))
                    ->label(__('City')),
                TagsColumn::make('tags')
                    ->limitList(2)
                    ->label(__('Features')),


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
                EditAction::make(),
                MediaAction::make('video_url')
                    ->label(__('Video'))
                    ->icon(Heroicon::OutlinedVideoCamera)
                    ->media(fn($record) => $record->video_url),
                Action::make('toggleActive')
                    ->label(fn($record) => $record->active ? __('Disable') : __('Enable'))
                    ->icon(fn($record) => $record->active ? 'heroicon-o-x-circle' : 'heroicon-o-check-circle')
                    ->color(fn($record) => $record->active ? 'danger' : 'success')
                    ->requiresConfirmation()
                    ->action(function ($record) {
                        $record->active = !$record->active;
                        $record->save();
                    }),

            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
