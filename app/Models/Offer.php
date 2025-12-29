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

class Offer extends Model
{
    use HasFactory,  HasSlug;

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
            ->saveSlugsTo('slug')->usingLanguage('ar');
    }

    public function getOfferItemsAttribute()
    {
        return collect($this->items ?? [])->map(function ($item) {
            if (!isset($item['bookable_type'], $item['bookable_id'])) return null;

            $modelClass = $item['bookable_type'];
            if (!class_exists($modelClass)) return null;

            $record = $modelClass::find($item['bookable_id']);
            if (!$record) return null;

            $days = $item['days'] ?? 1;

            // Determine label based on type
            $typeLabel = match ($modelClass) {
                'App\Models\Car' => 'سيارة',
                'App\Models\Apartment' => 'شقة',
                'App\Models\Hotel' => 'فندق',
                'App\Models\Service' => 'خدمة',
                default => 'عنصر'
            };

            $description = "{$typeLabel}: {$record->name}";
            if ($modelClass !== 'App\Models\Service') {
                $description .= " ( لمدة {$days} يوم )";
            }

            return $description;
        })->filter();
    }

    public function bookings()
    {
        return $this->morphMany(Booking::class, 'bookable');
    }
}
