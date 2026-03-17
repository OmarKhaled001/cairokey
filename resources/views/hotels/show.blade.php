@extends('layouts.master')

@section('name', $hotel->name . ' - ' . __('general.cairo_key'))

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
@endpush

@section('content')
    <div class="show-container container">
        @php
            $hasImages = $hotel->images && count($hotel->images) > 0;
            $hasCover = !empty($hotel->cover);
        @endphp

        @if ($hasImages || $hasCover)
            <div class="hotel-gallery shadow-xl">
                <div class="swiper mainSwiper">
                    <div class="swiper-wrapper">
                        @if ($hasCover)
                            <div class="swiper-slide">
                                <img src="{{ asset('storage/' . $hotel->cover) }}" alt="{{ $hotel->name }}">
                            </div>
                        @endif

                        @if ($hasImages)
                            @foreach ($hotel->images as $image)
                                <div class="swiper-slide">
                                    <img src="{{ asset('storage/' . $image) }}" alt="{{ $hotel->name }}">
                                </div>
                            @endforeach
                        @endif

                        @if (!$hasCover && !$hasImages)
                            <div class="swiper-slide">
                                <img src="https://placehold.co/600x400?text=Hotel" alt="{{ $hotel->name }}">
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
                <h1 class="hotel-title">{{ $hotel->name }}</h1>

                <div class="rating-section">
                    <div class="rating-display">
                        <x-star-rating :rating="$hotel->average_rating" :reviewsCount="0" :showCount="false" size="lg" />
                    </div>
                    <div class="trust-text">
                        <i class="fas fa-star"></i>
                        <span>{{ __('general.hotel_rating') }}</span>
                    </div>
                </div>

                <p style="font-size: 1.1rem; color: #64748b; margin-bottom: 2rem;">
                    <i class="fas fa-map-marker-alt text-primary ml-1"></i> {{ $hotel->city }}, {{ $hotel->governorate }}
                </p>

                <div class="description-section">
                    <h3 style="font-weight: 700; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 10px;">
                        <span
                            style="width: 4px; height: 24px; background: var(--primary-color); border-radius: 10px; display: inline-block;"></span>
                        {{ __('general.about_this_hotel') }}
                    </h3>
                    <p style="line-height: 2; color: #475569; font-size: 1.1rem;">{{ $hotel->description }}</p>
                </div>

                @if ($hotel->tags && count($hotel->tags) > 0)
                    <div class="amenities-section" style="margin-top: 3.5rem;">
                        <h3 style="font-weight: 700; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 10px;">
                            <span
                                style="width: 4px; height: 24px; background: var(--primary-color); border-radius: 10px; display: inline-block;"></span>
                        {{ __('general.amenities_and_services') }}
                        </h3>
                        <div class="tags-grid">
                            @foreach ($hotel->tags as $tag)
                                <div class="tag-item">
                                    <i class="fas fa-check-circle"></i>
                                    <span>{{ $tag }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <div class="booking-card">
                @php
                    $whatsappNumber = \App\Models\Setting::get('whatsapp');
                    $waMsg = __('general.whatsapp_inquiry_message') . ":\n";
                    $waMsg .= '🏠 ' . $hotel->name . "\n";
                    $cleanNumber = preg_replace('/[^0-9]/', '', $whatsappNumber);
                    $waUrl = 'https://wa.me/' . $cleanNumber . '?text=' . urlencode($waMsg);
                @endphp

                <p style="color: #64748b; margin-bottom: 2rem;">
                    {{ __('general.contact_us_whatsapp') }}
                </p>

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
