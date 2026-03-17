<?php

namespace App\Filament\Resources\Bookings\Schemas;

use App\Enums\BookingStatus;
use App\Models\Apartment;
use App\Models\Car;
use App\Models\Hotel;
use App\Models\Offer;
use App\Models\Service;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;

class BookingForm
{
    private static function getBookableModels(): array
    {
        return [
            Apartment::class => __('Apartment'),
            Hotel::class     => __('Hotel'),
            Service::class   => __('Service'),
            Car::class       => __('Car'),
            Offer::class     => __('Offer'),
        ];
    }

    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Select::make('bookable_type')
                ->label(__('Type of Booking'))
                ->required()
                ->options(self::getBookableModels())
                ->live()
                ->afterStateUpdated(fn(Set $set) => $set('bookable_id', null)),

            Select::make('bookable_id')
                ->label(__('Related Entity'))
                ->required()
                ->options(fn(Get $get) => self::getBookableOptions($get('bookable_type')))
                ->searchable()
                ->live()
                ->afterStateUpdated(fn($state, Set $set, Get $get) => self::updateTotalPrice($get, $set)),

            DatePicker::make('start_date')
                ->label(__('Date From'))
                ->required()
                ->live()
                ->disabledDates(fn(Get $get) => self::getReservedDates($get))
                ->afterStateUpdated(fn($state, Set $set, Get $get) => self::updateTotalPrice($get, $set)),

            DatePicker::make('end_date')
                ->label(__('Date To'))
                ->required()
                ->live()
                ->afterOrEqual('start_date')
                ->disabledDates(fn(Get $get) => self::getReservedDates($get))
                ->afterStateUpdated(fn($state, Set $set, Get $get) => self::updateTotalPrice($get, $set)),

            Select::make('client_id')
                ->label(__('Client'))
                ->relationship(name: 'client', titleAttribute: 'name')
                ->searchable()
                ->createOptionForm([
                    TextInput::make('name')
                        ->label(__('Name'))
                        ->required(),
                    TextInput::make('email')
                        ->label(__('Email'))
                        ->required()
                        ->email(),
                    TextInput::make('phone')
                        ->label(__('Phone'))
                        ->required(),
                ]),

            TextInput::make('total_price')
                ->label(__('Total Price'))
                ->numeric()
                ->readOnly()
                ->prefix('$')
                ->default(0),

            Select::make('status')
                ->label(__('Status'))
                ->options(BookingStatus::class)
                ->default(BookingStatus::Pending)
                ->required(),
        ]);
    }

    protected static function getBookableOptions(?string $type): array
    {
        if (! $type || ! class_exists($type)) {
            return [];
        }

        return $type::query()
            ->pluck('name', 'id')
            ->toArray();
    }

    protected static function updateTotalPrice(callable $get, callable $set): void
    {
        $start = $get('start_date');
        $end   = $get('end_date');
        $type  = $get('bookable_type');
        $id    = $get('bookable_id');

        if (! ($start && $end && $type && $id)) {
            $set('total_price', 0);
            return;
        }

        $model = $type::find($id);

        if (! $model) {
            $set('total_price', 0);
            return;
        }

        $startDate = Carbon::parse($start);
        $endDate = Carbon::parse($end);

        $price = 0;
        $duration = 0;

        switch ($type) {
            case Apartment::class:
            case Hotel::class:
                $price = $model->price_per_night ?? 0;
                $duration = $startDate->diffInDays($endDate);
                break;
            case Car::class:
                $price = $model->price_per_day ?? 0;
                $duration = $startDate->diffInDays($endDate) + 1;
                break;
            case Service::class:
                $price = $model->price ?? 0;
                $duration = 1;
                break;
            case Offer::class:
                $price = $model->price ?? 0;
                $duration = 1;

                $offerValidStart = Carbon::parse($model->start_date);
                $offerValidEnd = Carbon::parse($model->end_date);
                if ($startDate->lt($offerValidStart) || $endDate->gt($offerValidEnd)) {
                    $set('total_price', 0);
                    return;
                }
                break;
            default:
                $price = 0;
                $duration = 0;
                break;
        }

        $set('total_price', max($duration * $price, 0));
    }

    protected static function getReservedDates(Get $get): array
    {
        $type = $get('bookable_type');
        $id = $get('bookable_id');

        if (! $type || ! $id) {
            return [];
        }

        $model = $type::find($id);

        if (! $model || ! method_exists($model, 'bookings')) {
            return [];
        }

        $reservedDates = [];
        $bookings = $model->bookings()
            ->whereIn('status', [BookingStatus::Confirmed, BookingStatus::Pending])
            ->get(['start_date', 'end_date']);

        foreach ($bookings as $booking) {
            $period = CarbonPeriod::create($booking->start_date, $booking->end_date);
            foreach ($period as $date) {
                $reservedDates[] = $date->format('Y-m-d');
            }
        }

        return $reservedDates;
    }
}
