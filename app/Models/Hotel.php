<?php

namespace App\Models;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;

class Hotel extends Model implements TranslatableContract
{
    use HasFactory, HasSlug, Translatable;

    public array $translatedAttributes = ['name', 'description', 'city', 'tags'];

    protected $fillable = [
        'slug',
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

    protected $appends = ['average_rating', 'reviews_count'];

    // ─── Accessors ─────────────────────────────

    public function getAverageRatingAttribute()
    {
        return $this->rating ?? 0;
    }

    public function getReviewsCountAttribute()
    {
        return 0;
    }
    public function detailRoute(): string
    {
        return route('hotels.show', $this->slug);
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

    // ─── Scopes ─────────────────────

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('active', true);
    }

    public function scopeWithTranslation(Builder $query): Builder
    {
        return $query->with('translations');
    }

    public function scopeFilterByCity(Builder $query, ?string $city): Builder
    {
        return $query->when($city, function ($q) use ($city) {
            $q->whereHas('translations', function ($t) use ($city) {
                $t->where('locale', app()->getLocale())
                  ->where('city', $city);
            });
        });
    }

    public function scopeFilterByRating(Builder $query, ?string $rating): Builder
    {
        return $query->when($rating, fn($q) => $q->where('rating', '>=', $rating));
    }

    public function scopeSorted(Builder $query, string $sort = 'newest'): Builder
    {
        return match ($sort) {
            'highest_rated' => $query->orderByDesc('rating'),
            default         => $query->latest(),
        };
    }
}
