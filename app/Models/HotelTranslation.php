<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HotelTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['name', 'description', 'city', 'tags'];
    protected $casts    = ['tags' => 'array'];
}
