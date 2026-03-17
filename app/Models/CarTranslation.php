<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CarTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['name', 'description', 'brand', 'tags'];
    protected $casts    = ['tags' => 'array'];
}
