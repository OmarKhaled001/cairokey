<?php

namespace App\Models;

use Spatie\Tags\HasTags;
use Spatie\Sluggable\HasSlug;
use Spatie\MediaLibrary\HasMedia;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Car extends Model implements HasMedia
{
    use HasFactory, HasSlug, HasTags, InteractsWithMedia;

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
    ];

    protected $casts = [
        'active' => 'boolean',
        'featured' => 'boolean',
        'price_per_day' => 'decimal:2',
        'rating' => 'integer',
        'year' => 'integer',
        'images' => 'json',
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function bookings()
    {
        return $this->morphMany(Booking::class, 'bookable');
    }

    public function reviews()
    {
        return $this->morphMany(Review::class, 'reviewable');
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('images');
    }
}
