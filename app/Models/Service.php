<?php

namespace App\Models;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;

class Service extends Model implements TranslatableContract
{
    use HasFactory, HasSlug, Translatable;

    public array $translatedAttributes = ['name', 'description', 'tags'];

    protected $fillable = [
        'slug',
        'price',
        'icon',
        'cover',
        'images',
        'rating',
        'active',
        'featured',
    ];

    protected $casts = [
        'images'   => 'array',
        'active'   => 'boolean',
        'featured' => 'boolean',
    ];

    public function detailRoute(): string
{
    return route('services.show', $this->slug);
}

    // ─── Slug ─────────────────────────────

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug')
            ->usingLanguage('ar');
    }

    // ─── Relations ─────────────────────────────

    public function bookings()
    {
        return $this->morphMany(Booking::class, 'bookable');
    }

    // ─── Scopes ─────────────────────────────

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('active', true);
    }

    public function scopeWithTranslation(Builder $query): Builder
    {
        return $query->with('translations');
    }

    public function scopeSorted(Builder $query, string $sort = 'newest'): Builder
    {
        return match ($sort) {
            'lowest_price'  => $query->orderBy('price', 'asc'),
            'highest_price' => $query->orderBy('price', 'desc'),
            'highest_rated' => $query->orderByDesc('rating'),
            default         => $query->latest(),
        };
    }
}
