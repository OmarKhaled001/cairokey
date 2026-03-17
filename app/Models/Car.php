<?php

namespace App\Models;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;

class Car extends Model implements TranslatableContract
{
    use HasFactory, HasSlug, Translatable;

    public array $translatedAttributes = ['name', 'description', 'brand', 'tags'];

    protected $fillable = [
        'slug',
        'cover',
        'images',
        'price_per_day',
        'rating',
        'active',
        'featured',
    ];

    protected $casts = [
        'images'   => 'array',
        'active'   => 'boolean',
        'featured' => 'boolean',
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug')
            ->usingLanguage('ar');
    }

    public function bookings()
    {
        return $this->morphMany(Booking::class, 'bookable');
    }

    public function detailRoute(): string
    {
        return route('cars.show', $this->slug);
    }

    // ─── SCOPES ─────────────────────────────

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('active', true);
    }

    public function scopeWithTranslation(Builder $query): Builder
    {
        return $query->with('translations');
    }

    public function scopeFilterByPrice(Builder $query, ?string $min, ?string $max): Builder
    {
        return $query
            ->when($min, fn($q) => $q->where('price_per_day', '>=', $min))
            ->when($max, fn($q) => $q->where('price_per_day', '<=', $max));
    }

    public function scopeFilterByBrand(Builder $query, ?string $brand): Builder
    {
        return $query->when($brand, function ($q) use ($brand) {
            $q->whereHas('translations', function ($t) use ($brand) {
                $t->where('locale', app()->getLocale())
                    ->where('brand', $brand);
            });
        });
    }

    public function scopeSorted(Builder $query, string $sort = 'newest'): Builder
    {
        return match ($sort) {
            'lowest_price' => $query->orderBy('price_per_day', 'asc'),
            'highest_price' => $query->orderBy('price_per_day', 'desc'),
            default         => $query->latest(),
        };
    }
}
