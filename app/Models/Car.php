<?php

namespace App\Models;

use Spatie\Tags\HasTags;
use Spatie\Sluggable\HasSlug;
use Spatie\MediaLibrary\HasMedia;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Car extends Model
{
    use HasFactory, HasSlug;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'model',
        'brand',
        'year',
        'price_per_day',
        'transmission',
        'fuel_type',
        'rating',
        'active',
        'featured',
        'cover',
        'images',
        'tags',
    ];

    protected $casts = [
        'active' => 'boolean',
        'featured' => 'boolean',
        'price_per_day' => 'decimal:2',
        'rating' => 'integer',
        'year' => 'integer',
        'images' => 'array',
        'tags' => 'array',
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug')->usingLanguage('ar');
    }

    public function bookings()
    {
        return $this->morphMany(Booking::class, 'bookable');
    }
}
