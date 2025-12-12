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
    protected static ?string $title = 'الحجوزات';
    protected static ?string $modelLabel = 'حجز';
    protected static ?string $pluralModelLabel = 'الحجوزات';
    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('type')
                    ->label('نوع الحجز')
                    ->options([
                        'apartment' => 'شقة',
                        'hotel' => 'فندق',
                        'car' => 'سيارة',
                    ])
                    ->required(),

                TextInput::make('price')
                    ->label('السعر')
                    ->numeric()
                    ->required(),

                DatePicker::make('start_date')
                    ->label('تاريخ البداية')
                    ->required(),

                DatePicker::make('end_date')
                    ->label('تاريخ النهاية')
                    ->required(),

                Toggle::make('active')
                    ->label('نشط')
                    ->default(true),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('type')
            ->columns([

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
