@extends('layouts.master')

@section('name', $apartment->name . ' - ' . __('general.cairo_key'))

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
@endpush

@section('content')
    <div class="show-container container">
        @php
            $videoId = null;
            if ($apartment->video_url) {
                preg_match(
                    '%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i',
                    $apartment->video_url,
                    $match,
                );
                $videoId = $match[1] ?? null;
            }
            $hasImages = $apartment->images && count($apartment->images) > 0;
        @endphp

        @if ($videoId || $hasImages || $apartment->cover)
            <div class="apartment-gallery shadow-xl">
                <div class="swiper mainSwiper">
                    <div class="swiper-wrapper">
                        @if ($videoId)
                            <div class="swiper-slide">
                                <div class="video-container">
                                    <iframe src="https://www.youtube.com/embed/{{ $videoId }}"
                                        allowfullscreen></iframe>
                                </div>
                            </div>
                        @endif

                        @if ($hasImages)
                            @foreach ($apartment->images as $image)
                                <div class="swiper-slide">
                                    <img src="{{ $image ? asset('storage/' . $image) : 'https://placehold.co/600x400?text=Apartment' }}"
                                        alt="{{ $apartment->name }}">
                                </div>
                            @endforeach
                        @else
                            <div class="swiper-slide">
                                <img src="{{ $apartment->cover ? asset('storage/' . $apartment->cover) : 'https://placehold.co/600x400?text=Apartment' }}"
                                    alt="{{ $apartment->name }}">
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
                <span class="badge"
                    style="background: var(--primary-color); color: white; padding: 5px 15px; border-radius: 50px; font-size: 0.8rem; font-weight: bold; margin-bottom: 1rem; display: inline-block;">{{ __('general.featured_accommodation') }}</span>
                <h1 class="apartment-title">{{ $apartment->name }}</h1>
                <p style="font-size: 1.1rem; color: #64748b; margin-bottom: 2rem;">
                    <i class="fas fa-map-marker-alt text-primary ml-1"></i> {{ $apartment->city }}
                </p>

                <div class="description-section">
                    <h3 style="font-weight: 700; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 10px;">
                        <span
                            style="width: 4px; height: 24px; background: var(--primary-color); border-radius: 10px; display: inline-block;"></span>
                        {{ __('general.about_this_apartment') }}
                    </h3>
                    <p style="line-height: 2; color: #475569; font-size: 1.1rem;">{{ $apartment->description }}</p>
                </div>

                <div class="amenities-section" style="margin-top: 3.5rem;">
                    <h3 style="font-weight: 700; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 10px;">
                        <span
                            style="width: 4px; height: 24px; background: var(--primary-color); border-radius: 10px; display: inline-block;"></span>
                        {{ __('general.amenities_and_services') }}
                    </h3>
                    <div class="tags-grid">
                        <div class="tag-item">
                            <i class="fas fa-bed"></i>
                            <span>{{ $apartment->rooms }} {{ __('general.bedrooms') }}</span>
                        </div>
                        @if ($apartment->tags)
                            @foreach ($apartment->tags as $tag)
                                <div class="tag-item">
                                    <i class="fas fa-check-circle"></i>
                                    <span>{{ $tag }}</span>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>

            <div class="booking-card border-0">
                <div class="price-box shadow-2xl"
                    style="background: #0f172a; color: white; padding: 2rem 1.5rem; border-radius: 24px; margin-bottom: 2rem; display: flex; align-items: center; justify-content: space-between;">
                    <div style="flex-grow: 1; text-align: center;">
                        <span
                            style="font-size: 0.85rem; display: block; opacity: 0.7; margin-bottom: 8px; letter-spacing: 1px;">{{ __('general.average_per_night') }}</span>
                        <div style="display: flex; align-items: center; justify-content: center; gap: 10px;">
                            <span
                                style="font-size: 2.2rem; font-weight: 800;">{{ number_format($apartment->min_price, 0) }}</span>
                            <span style="font-size: 1.5rem; opacity: 0.5;">—</span>
                            <span
                                style="font-size: 2.2rem; font-weight: 800;">{{ number_format($apartment->max_price, 0) }}</span>
                            <span style="font-size: 1.8rem; margin-right: 5px;">$</span>
                        </div>
                    </div>

                    <div style="display: flex; flex-direction: column; align-items: flex-end; gap: 5px; color: #64748b;">
                        <i class="fas fa-info-circle" style="font-size: 1.2rem; margin-bottom: 5px;"></i>
                        <span style="font-size: 0.8rem; font-weight: 600; text-align: left;"></span>
                    </div>
                </div>

                @php
                    $whatsappNumber = \App\Models\Setting::get('whatsapp');
                    $waMsg = __('general.whatsapp_inquiry_message') . ":\n";
                    $waMsg .= '🏠 ' . $apartment->name . "\n";
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
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://npmcdn.com/flatpickr/dist/l10n/ar.js"></script>
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
        });

        new Swiper(".relatedSwiper", {
            slidesPerView: 1,
            spaceBetween: 20,
            navigation: {
                nextEl: ".swiper-button-next-related",
                prevEl: ".swiper-button-prev-related",
            },
            breakpoints: {
                640: {
                    slidesPerView: 2
                },
                1024: {
                    slidesPerView: 3
                },
                1280: {
                    slidesPerView: 4
                },
            },
            loop: true,
        });
    </script>
@endpush
