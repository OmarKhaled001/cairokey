{{-- Star Rating Component --}}
@props([
    'rating' => 0,
    'reviewsCount' => 0,
    'size' => 'md', // sm, md, lg
    'showText' => true,
    'showCount' => true,
])

@php
    $fullStars = floor($rating);
    $hasHalfStar = $rating - $fullStars >= 0.5;
    $emptyStars = 5 - $fullStars - ($hasHalfStar ? 1 : 0);

    $sizeClasses = [
        'sm' => 'text-sm',
        'md' => 'text-base',
        'lg' => 'text-xl',
    ];

    $starSizes = [
        'sm' => '14px',
        'md' => '18px',
        'lg' => '24px',
    ];
@endphp

<div class="rating-component inline-flex items-center gap-2" {{ $attributes }}>
    <div class="stars inline-flex items-center gap-1" style="font-size: {{ $starSizes[$size] }};"
        title="تقييم النزلاء بناءً على {{ $reviewsCount }} تقييم">

        {{-- Full Stars --}}
        @for ($i = 0; $i < $fullStars; $i++)
            <i class="fas fa-star" style="color: var(--primary-color);"></i>
        @endfor

        {{-- Half Star --}}
        @if ($hasHalfStar)
            <i class="fas fa-star-half-alt" style="color: var(--primary-color);"></i>
        @endif

        {{-- Empty Stars --}}
        @for ($i = 0; $i < $emptyStars; $i++)
            <i class="far fa-star" style="color: #E0E0E0;"></i>
        @endfor
    </div>

    @if ($showText || $showCount)
        <div class="rating-text inline-flex items-center gap-1 {{ $sizeClasses[$size] }}">
            @if ($showText)
                <span class="rating-value font-bold" style="color: var(--secondary-color);">
                    {{ number_format($rating, 1) }}
                </span>
            @endif

            @if ($showCount && $reviewsCount > 0)
                <span class="reviews-count" style="color: #64748b;">
                    ({{ $reviewsCount }} تقييم)
                </span>
            @endif
        </div>
    @endif
</div>

<style>
    .rating-component .stars i {
        transition: transform 0.2s ease;
    }

    .rating-component:hover .stars i {
        transform: scale(1.1);
    }

    .rating-component .stars {
        cursor: help;
    }
</style>
