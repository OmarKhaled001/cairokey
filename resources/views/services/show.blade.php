@extends('layouts.master')

@section('name', $service->name . ' - ' . __('general.cairo_key'))

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
@endpush

@section('content')
    <div class="show-container container">
        @php
            $hasImages = $service->images && count($service->images) > 0;
            $hasCover = !empty($service->cover);
        @endphp

        @if ($hasImages || $hasCover)
            <div class="service-gallery shadow-xl">
                <div class="swiper mainSwiper">
                    <div class="swiper-wrapper">
                        @if ($hasCover)
                            <div class="swiper-slide">
                                <img src="{{ asset('storage/' . $service->cover) }}" alt="{{ $service->name }}">
                            </div>
                        @endif

                        @if ($hasImages)
                            @foreach ($service->images as $image)
                                <div class="swiper-slide">
                                    <img src="{{ asset('storage/' . $image) }}" alt="{{ $service->name }}">
                                </div>
                            @endforeach
                        @endif

                        @if (!$hasCover && !$hasImages)
                            <div class="swiper-slide">
                                <img src="https://placehold.co/1200x500?text=Service+Image" alt="{{ $service->name }}">
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
                <h1 class="service-title">{{ $service->name }}</h1>

                <div class="description-section">
                    <h3 style="font-weight: 700; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 10px;">
                        <span
                            style="width: 4px; height: 24px; background: var(--primary-color); border-radius: 10px; display: inline-block;"></span>
                        {{ __('general.service_details') }}
                    </h3>
                    <p style="line-height: 2; color: #475569; font-size: 1.1rem;">{{ $service->description }}</p>
                </div>

                @if ($service->tags && is_array($service->tags) && count($service->tags) > 0)
                    <div class="amenities-section" style="margin-top: 3.5rem;">
                        <h3 style="font-weight: 700; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 10px;">
                            <span
                                style="width: 4px; height: 24px; background: var(--primary-color); border-radius: 10px; display: inline-block;"></span>
                            {{ __('general.service_features') }}
                        </h3>
                        <div class="tags-grid">
                            @foreach ($service->tags as $tag)
                                <div class="tag-item">
                                    <i class="fas fa-check-circle"></i>
                                    <span>{{ $tag }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <div class="booking-card" style="text-align: center;">
                @php
                    use App\Models\Setting;
                    $whatsapp = Setting::get('whatsapp');
                    $message = __('general.whatsapp_inquiry_message') . ': ' . $service->name;
                    $whatsappLink = 'https://wa.me/' . $whatsapp . '?text=' . urlencode($message);
                @endphp

                <h3 style="font-weight: 800; margin-bottom: 1.5rem; color: var(--secondary-color);">{{ __('general.interested_in_this_service') }}</h3>
                <p style="color: #64748b; margin-bottom: 2rem;">
                    {{ __('general.contact_us_whatsapp_service') }}
                </p>

                <a href="{{ $whatsappLink }}" target="_blank" class="whatsapp-btn">
                    <i class="fab fa-whatsapp"></i>
                    {{ __('general.contact_us_now') }}
                </a>
                <p style="text-align: center; color: #94a3b8; font-size: 0.85rem; margin-top: 1.25rem;">
                    <i class="fas fa-info-circle ml-1"></i> {{ __('general.instant_reply') }}
                </p>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/ar.js"></script>
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
