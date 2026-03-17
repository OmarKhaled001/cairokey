@extends('layouts.master')

@section('name', $car->brand . ' ' . $car->name . ' - ' . __('general.cairo_key'))

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
@endpush

@section('content')
    <div class="show-container container">
        @php
            $hasImages = $car->images && count($car->images) > 0;
            $hasCover = !empty($car->cover);
        @endphp

        @if ($hasImages || $hasCover)
            <div class="car-gallery shadow-xl">
                <div class="swiper mainSwiper">
                    <div class="swiper-wrapper">
                        @if ($hasCover)
                            <div class="swiper-slide">
                                <img src="{{ asset('storage/' . $car->cover) }}" alt="{{ $car->name }}">
                            </div>
                        @endif

                        @if ($hasImages)
                            @foreach ($car->images as $image)
                                <div class="swiper-slide">
                                    <img src="{{ asset('storage/' . $image) }}" alt="{{ $car->name }}">
                                </div>
                            @endforeach
                        @endif

                        @if (!$hasCover && !$hasImages)
                            <div class="swiper-slide">
                                <img src="https://placehold.co/600x400?text=Car" alt="{{ $car->name }}">
                            </div>
                        @endif
                    </div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        @endif

        <div class="details-grid">
            <div class="info-card">
                <h1 class="apartment-title">{{ $car->name }}</h1>
                <span class="badge"
                    style="background: var(--primary-color); color: white; padding: 5px 15px; border-radius: 50px; font-size: 0.8rem; font-weight: bold; margin-bottom: 1rem; display: inline-block;">
                    {{ $car->brand }}
                </span>

                <div class="description-section">
                    <h3 style="font-weight: 700; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 10px;">
                        <span
                            style="width: 4px; height: 24px; background: var(--primary-color); border-radius: 10px; display: inline-block;"></span>
                        {{ __('general.about_this_car') }}
                    </h3>
                    <p style="line-height: 2; color: #475569; font-size: 1.1rem;">{{ $car->description }}</p>
                </div>

                <div class="amenities-section" style="margin-top: 3.5rem;">
                    <h3 style="font-weight: 700; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 10px;">
                        <span
                            style="width: 4px; height: 24px; background: var(--primary-color); border-radius: 10px; display: inline-block;"></span>
                        {{ __('general.basic_specifications') }}
                    </h3>
                    <div class="tags-grid">
                        @if ($car->tags)
                            @foreach ($car->tags as $tag)
                                <div class="tag-item">
                                    <i class="fas fa-check-circle"></i>
                                    <span>{{ $tag }}</span>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>

            <div class="booking-card">
                <div class="price-box shadow-lg">
                    <span class="unit">{{ __('general.starts_from') }}</span>
                    <span class="amount">${{ $car->price_per_day }}</span>
                    <span class="unit">{{ __('general.per_day') }}</span>
                </div>

                @php
                    $whatsappNumber = \App\Models\Setting::get('whatsapp');
                    $waMsg = __('general.whatsapp_inquiry_message') . ":\n";
                    $waMsg .= '🚗 ' . $car->name . "\n";
                    $cleanNumber = preg_replace('/[^0-9]/', '', $whatsappNumber);
                    $waUrl = 'https://wa.me/' . $cleanNumber . '?text=' . urlencode($waMsg);
                @endphp

                <a href="{{ $waUrl }}" target="_blank" class="whatsapp-btn"
                    style="background: #25D366; color: white; padding: 1.2rem; border-radius: 20px; display: flex; align-items: center; justify-content: center; gap: 12px; font-weight: 700; font-size: 1.15rem; text-decoration: none; transition: 0.4s ease; box-shadow: 0 12px 24px -8px rgba(37, 211, 102, 0.5);">
                    <i class="fab fa-whatsapp" style="font-size: 1.7rem;"></i>
                    {{ __('general.book_now') }}
                </a>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        new Swiper(".mainSwiper", {
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev"
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
                dynamicBullets: true
            },
            loop: true,
            autoplay: {
                delay: 3000,
                disableOnInteraction: false,
            },
            speed: 600,
        });
    </script>
@endpush
