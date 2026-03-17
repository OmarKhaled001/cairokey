<?php

namespace App\Filament\Widgets;

use App\Models\Car;
use App\Models\User;
use App\Models\Hotel;
use App\Models\Offer;
use App\Models\Booking;
use App\Models\Service;
use App\Models\Apartment;
use Filament\Support\Colors\Color;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends StatsOverviewWidget
{
    // يمكن تعيين فترة تحديث أطول لتقليل ضغط القاعدة
    protected ?string $pollingInterval = '30s';
    protected function getStats(): array
    {
        $totalBookingsRevenue = Booking::query()
            ->where('status', 'completed')
            ->sum('total_price');

        $activeHotels = Hotel::where('active', true)->count();
        $activeApartments = Apartment::where('active', true)->count();

        $activeOffers = Offer::where('active', true)->count();

        $activeCars = Car::where('active', true)->count();
        $activeServices = Service::where('active', true)->count();

        return [


            Stat::make(__('Active Hotels'), $activeHotels)
                ->description(__('Hotels currently available for booking'))
                ->descriptionIcon('heroicon-o-building-office')
                ->color(Color::Blue),

            Stat::make(__('Active Apartments'), $activeApartments)
                ->description(__('Apartments currently available for booking'))
                ->descriptionIcon('heroicon-o-home')
                ->color(Color::Blue),

            Stat::make(__('Active Cars'), $activeCars)
                ->description(__('Cars available for rent'))
                ->descriptionIcon('heroicon-o-truck')
                ->color(Color::Teal),

            Stat::make(__('Active Services'), $activeServices)
                ->description(__('Activated and available services'))
                ->descriptionIcon('heroicon-o-wrench-screwdriver')
                ->color(Color::Teal),



            Stat::make(__('Active Offers'), $activeOffers)
                ->description(__('Activated promotional offers'))
                ->descriptionIcon('heroicon-o-fire')
                ->color(Color::Orange),

            Stat::make(__('Number of Users'), User::count())
                ->description(__('Total registered users'))
                ->descriptionIcon('heroicon-o-users')
                ->color(Color::Gray),
        ];
    }
}
