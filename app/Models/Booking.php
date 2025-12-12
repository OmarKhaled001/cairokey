<?php

namespace App\Models;

use App\Enums\BookingStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
}
