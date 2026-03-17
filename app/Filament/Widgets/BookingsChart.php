<?php

namespace App\Filament\Widgets;

use Carbon\Carbon;
use App\Models\Booking;
use Filament\Widgets\BarChartWidget;

class BookingsChart extends BarChartWidget
{
    public function getHeading(): string
    {
        return __('Bookings over the last 7 days');
    }

    protected int | string | array $columnSpan = 'full';
    protected function getData(): array
    {
        $labels = [];
        $values = [];

        for ($i = 6; $i >= 0; $i--) {
            $day = Carbon::now()->subDays($i)->format('Y-m-d');
            $labels[] = Carbon::now()->subDays($i)->format('d M');

            $values[] = Booking::whereDate('created_at', $day)->count();
        }

        return [
            'datasets' => [
                [
                    'label' => __('Number of Bookings'),
                    'data' => $values,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
