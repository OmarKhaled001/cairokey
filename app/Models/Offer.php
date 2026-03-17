<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Offer extends Model implements TranslatableContract
{
    use HasFactory, HasSlug, Translatable;

    public array $translatedAttributes = ['name', 'description'];

    protected $fillable = [
        'slug',
        'price',
        'original_price',
        'cover',
        'items',
        'start_date',
        'end_date',
        'active',
        'featured',
    ];

    protected $casts = [
        'items'        => 'array',
        'active'       => 'boolean',
        'featured'     => 'boolean',
        'start_date'   => 'date',
        'end_date'     => 'date',
    ];

    protected $appends = [
        'offer_items',
        'discount_percent',
        'has_discount',
    ];

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

    public function scopeAvailable(Builder $query): Builder
    {
        return $query->where('active', true)
            ->whereDate('start_date', '<=', now())
            ->whereDate('end_date', '>=', now());
    }

    public function scopeFeatured(Builder $query): Builder
    {
        return $query->where('featured', true);
    }

    public function scopeWithTranslation(Builder $query): Builder
    {
        return $query->with('translations');
    }

    public function scopeSorted(Builder $query, string $sort = 'newest'): Builder
    {
        return match ($sort) {
            'highest_discount' => $query->orderByRaw('(original_price - price) DESC'),
            default            => $query->latest(),
        };
    }

    // ─── Accessors ─────────────────────────────

    public function getOfferItemsAttribute()
    {
        return collect($this->items ?? [])
            ->map(function ($item) {

                if (!isset($item['bookable_type'], $item['bookable_id'])) {
                    return null;
                }

                $days = $item['days'] ?? 1;

                $typeLabel = match ($item['bookable_type']) {
                    'App\Models\Car' => 'سيارة',
                    'App\Models\Apartment' => 'شقة',
                    'App\Models\Hotel' => 'فندق',
                    'App\Models\Service' => 'خدمة',
                    default => 'عنصر'
                };

                return $typeLabel
                    . " #" . $item['bookable_id']
                    . ($item['bookable_type'] !== 'App\Models\Service'
                        ? " لمدة {$days} يوم"
                        : '');

            })
            ->filter()
            ->values();
    }

    public function getHasDiscountAttribute(): bool
    {
        return $this->original_price && $this->original_price > $this->price;
    }

    public function getDiscountPercentAttribute(): int
    {
        if (!$this->has_discount) {
            return 0;
        }

        return (int) round(
            (($this->original_price - $this->price) / $this->original_price) * 100
        );
    }

    // ─── Helpers ─────────────────────────────

    public function isActive(): bool
    {
        return $this->active
            && now()->between($this->start_date, $this->end_date);
    }
}
