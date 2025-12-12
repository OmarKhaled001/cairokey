<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReservedDate extends Model
{
    use HasFactory;

    protected $fillable = [
        'reservable_type',
        'reservable_id',
        'date_from',
        'date_to',
        'client_id',
        'auto_blocked',
    ];

    protected $casts = [
        'date_from' => 'date',
        'date_to' => 'date',
        'auto_blocked' => 'boolean',
    ];

    public function reservable()
    {
        return $this->morphTo();
    }
    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }
}
