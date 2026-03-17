<?php

namespace App\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder; // ← this one, not Query\Builder
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Apartment extends Model implements TranslatableContract
{
    use HasFactory, HasSlug, Translatable;

    public array $translatedAttributes = ['name', 'description', 'city', 'tags'];

    protected $fillable = [
        'slug',
        'min_price',
        'max_price',
        'video_url',
        'cover',
        'images',
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
            ->saveSlugsTo('slug')->usingLanguage('ar');
    }
    public function detailRoute(): string
    {
        return route('apartments.show', $this->slug);
    }


    public function bookings()
    {
        return $this->morphMany(Booking::class, 'bookable');
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('active', true);
    }

    public function scopeFilterByPrice(Builder $query, ?string $min, ?string $max): Builder
    {
        return $query
            ->when($min, fn($q) => $q->where('max_price', '>=', $min))
            ->when($max, fn($q) => $q->where('min_price', '<=', $max));
    }

    public function scopeFilterByCity(Builder $query, ?string $city): Builder
    {
        return $query->when(
            $city,
            fn($q) =>
            $q->whereHas(
                'translations',
                fn($t) =>
                $t->where('locale', app()->getLocale())
                    ->where('city', $city)
            )
        );
    }

    public function scopeSorted(Builder $query, string $sort = 'newest'): Builder
    {
        return match ($sort) {
            'lowest_price' => $query->orderBy('min_price', 'asc'),
            'highest_price' => $query->orderBy('max_price', 'desc'),
            default         => $query->latest(),
        };
    }
}
