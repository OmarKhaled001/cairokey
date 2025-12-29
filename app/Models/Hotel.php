<?php

namespace App\Models;

use Spatie\Tags\HasTags;
use Spatie\Sluggable\HasSlug;
use Spatie\MediaLibrary\HasMedia;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Hotel extends Model implements HasMedia
{
    use HasFactory, HasSlug,  InteractsWithMedia;

    protected $fillable = [
        'name',
        'slug',
        'location',
        'governorate',
        'city',
        'address',
        'price_per_night',
        'description',
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
        'price_per_night' => 'decimal:2',
        'rating' => 'integer',
        'images' => 'array',
        'tags' => 'array',
    ];

    protected $appends = ['average_rating', 'reviews_count'];

    public function getAverageRatingAttribute()
    {
        // Use the rating field from hotels table directly
        return $this->rating ?? 0;
    }

    public function getReviewsCountAttribute()
    {
        // Not using reviews, return 0 or optionally remove this
        return 0;
    }

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
