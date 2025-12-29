<?php

namespace App\Filament\Resources\Bookings\Tables;

use App\Models\Car;
use App\Models\Hotel;
use App\Models\Offer;
use App\Models\Service;
use App\Models\Apartment;
use Filament\Tables\Table;
use App\Enums\BookingStatus;
use Filament\Actions\Action;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Actions\BulkActionGroup;
use Filament\Forms\Components\Select;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Notifications\Notification;
use Illuminate\Support\Collection;

class BookingsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('client.name')
                    ->label('العميل')
                    ->url(fn($record): string => route('filament.admin.resources.clients.view', ['record' => $record->client]))
                    ->sortable()
                    ->searchable(),

                TextColumn::make('bookable_type')
                    ->label('الحجز')
                    ->formatStateUsing(function ($state, $record) {
                        $bookableModels = [
                            Apartment::class => 'شقة',
                            Hotel::class     => 'فندق',
                            Service::class   => 'خدمة',
                            Car::class       => 'سيارة',
                            Offer::class     => 'عرض',
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
                    ->label('من تاريخ')
                    ->date()
                    ->sortable(),

                TextColumn::make('end_date')
                    ->label('إلى تاريخ')
                    ->date()
                    ->sortable(),

                TextColumn::make('total_price')
                    ->label('الإجمالي')
                    ->numeric()
                    ->suffix(' $')
                    ->badge()
                    ->color('success')
                    ->sortable(),

                TextColumn::make('status')
                    ->label('الحالة')
                    ->badge()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label('تاريخ الإنشاء')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->label('آخر تحديث')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),

                EditAction::make()

                    ->hidden(fn($record): bool => $record->status === BookingStatus::Completed),

                Action::make('changeStatus')
                    ->label('تغيير الحالة')
                    ->icon(fn($record) => $record->status->getIcon())
                    ->color('gray')
                    ->hidden(fn($record): bool => $record->status === BookingStatus::Completed)
                    ->form([
                        Select::make('new_status')
                            ->label('الحالة الجديدة')
                            ->options(BookingStatus::class)
                            ->required()
                            ->default(fn($record) => $record->status->value)
                            ->columnSpanFull(),
                    ])
                    ->action(function ($record, array $data) {
                        $record->update(['status' => $data['new_status']]);
                        $newStatusLabel = BookingStatus::tryFrom($data['new_status'])->getLabel() ?? 'مجهولة';
                        $record->update(['status' => $newStatusLabel]);
                        Notification::make()
                            ->title('تم تحديث حالة الحجز')
                            ->body("تم تغيير حالة الحجز بنجاح إلى {$newStatusLabel}")
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
