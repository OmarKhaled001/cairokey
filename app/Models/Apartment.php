<?php

namespace App\Models;

use Spatie\Tags\HasTags;
use Spatie\Sluggable\HasSlug;
use Spatie\MediaLibrary\HasMedia;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Apartment extends Model implements HasMedia
{
    use HasFactory, HasSlug, InteractsWithMedia;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'governorate',
        'city',
        'address',
        'location',
        'rooms',
        'video_url',
        'cover',
        'images',
        'price_per_night',
        'rating',
        'active',
        'featured',
        'tags',
    ];

    protected $casts = [
        'active' => 'boolean',
        'featured' => 'boolean',
        'price_per_night' => 'decimal:2',
        'rating' => 'integer',
        'rooms' => 'integer',
        'images' => 'array',
        'tags' => 'array',
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
}
