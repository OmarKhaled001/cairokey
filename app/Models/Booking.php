<?php

namespace App\Models;

use App\Enums\BookingStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'bookable_type',
        'bookable_id',
        'start_date',
        'end_date',
        'total_price',
        'status',
    ];

    protected $casts = [
        'total_price' => 'decimal:2',
        'start_date' => 'date',
        'end_date' => 'date',
        'status' => BookingStatus::class,
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function bookable()
    {
        return $this->morphTo();
    }


    public static function hasConflict(
        string $bookableType,
        int $bookableId,
        $startDate,
        $endDate,
        ?int $ignoreBookingId = null
    ): bool {
        return self::query()
            ->where('bookable_type', $bookableType)
            ->where('bookable_id', $bookableId)
            ->whereIn('status', [
                BookingStatus::Confirmed,
                BookingStatus::Pending,
            ])
            ->when(
                $ignoreBookingId,
                fn($q) =>
                $q->where('id', '!=', $ignoreBookingId)
            )
            ->where(function (Builder $q) use ($startDate, $endDate) {
                $q->where('start_date', '<', $endDate)
                    ->where('end_date', '>', $startDate);
            })
            ->exists();
    }
}
