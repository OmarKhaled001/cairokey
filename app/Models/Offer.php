<?php

namespace App\Models;

use Spatie\Tags\HasTags;
use Spatie\Sluggable\HasSlug;
use Spatie\MediaLibrary\HasMedia;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Offer extends Model implements HasMedia
{
    use HasFactory, HasTags, HasSlug, InteractsWithMedia;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'price',
        'original_price',
        'items',
        'start_date',
        'end_date',
        'active',
        'featured',
        'cover',
        'tags',
    ];

    protected $casts = [
        'items' => 'array',
        'price' => 'decimal:2',
        'original_price' => 'decimal:2',
        'start_date' => 'date',
        'end_date' => 'date',
        'active' => 'boolean',
        'featured' => 'boolean',
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
