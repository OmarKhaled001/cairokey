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
            Stat::make('إجمالي إيرادات الحجوزات', number_format($totalBookingsRevenue) . ' $')
                ->description('إجمالي الإيرادات من الحجوزات المكتملة')
                ->descriptionIcon('heroicon-o-currency-dollar')
                ->color(Color::Green),

            Stat::make('فنادق نشطة', $activeHotels)
                ->description('الفنادق المتاحة حاليًا للحجز')
                ->descriptionIcon('heroicon-o-building-office')
                ->color(Color::Blue),

            Stat::make('شقق نشطة', $activeApartments)
                ->description('الشقق المتاحة حاليًا للحجز')
                ->descriptionIcon('heroicon-o-home')
                ->color(Color::Blue),

            Stat::make('سيارات نشطة', $activeCars)
                ->description('السيارات المتاحة للإيجار')
                ->descriptionIcon('heroicon-o-truck')
                ->color(Color::Teal),

            Stat::make('خدمات نشطة', $activeServices)
                ->description('الخدمات المفعلة والمتاحة')
                ->descriptionIcon('heroicon-o-wrench-screwdriver')
                ->color(Color::Teal),

            Stat::make('إجمالي الحجوزات', Booking::count())
                ->description('إجمالي الحجوزات في النظام')
                ->descriptionIcon('heroicon-o-calendar')
                ->color(Color::Yellow),

            Stat::make('عروض نشطة', $activeOffers)
                ->description('العروض الترويجية المفعلة')
                ->descriptionIcon('heroicon-o-fire')
                ->color(Color::Orange),

            Stat::make('عدد المستخدمين', User::count())
                ->description('إجمالي المستخدمين المسجلين')
                ->descriptionIcon('heroicon-o-users')
                ->color(Color::Gray),
        ];
    }
}
