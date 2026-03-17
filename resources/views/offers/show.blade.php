@extends('layouts.master')

@section('name', $offer->name . ' - ' . __('general.cairo_key'))

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
@endpush

@section('content')
    <div class="show-container container">
        <div class="offer-cover-container shadow-xl">
            <img src="{{ $offer->cover ? asset('storage/' . $offer->cover) : 'https://placehold.co/1200x500?text=Offer+Image' }}"
                alt="{{ $offer->name }}">
            <div
                style="position: absolute; bottom: 0; left: 0; right: 0; height: 100px; background: linear-gradient(transparent, rgba(0,0,0,0.2));">
            </div>
        </div>

        <div class="details-grid">
            <div class="info-card">
                <h1 class="offer-title">{{ $offer->name }}</h1>

                @if ($offer->start_date && $offer->end_date)
                    <p style="font-size: 1.1rem; color: #64748b; margin-bottom: 2rem;">
                        <i class="fas fa-calendar-alt text-primary ml-1"></i>
                        {{ __('general.available_from') }} {{ \Carbon\Carbon::parse($offer->start_date)->translatedFormat('d F Y') }}
                        {{ __('general.to') }} {{ \Carbon\Carbon::parse($offer->end_date)->translatedFormat('d F Y') }}
                    </p>
                @endif

                <div class="description-section">
                    <h3 style="font-weight: 700; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 10px;">
                        <span
                            style="width: 4px; height: 24px; background: var(--primary-color); border-radius: 10px; display: inline-block;"></span>
                        {{ __('general.offer_details') }}
                    </h3>
                    <p style="line-height: 2; color: #475569; font-size: 1.1rem;">{{ $offer->description }}</p>
                </div>

                @if ($offer->offer_items && $offer->offer_items->count() > 0)
                    <div class="amenities-section" style="margin-top: 3.5rem;">
                        <h3 style="font-weight: 700; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 10px;">
                            <span
                                style="width: 4px; height: 24px; background: var(--primary-color); border-radius: 10px; display: inline-block;"></span>
                            {{ __('general.whats_included') }}
                        </h3>
                        <ul class="offer-items-list">
                            @foreach ($offer->offer_items as $item)
                                <li>
                                    <i class="fas fa-check-circle"></i>
                                    <span>{{ $item }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if ($offer->tags && is_array($offer->tags) && count($offer->tags) > 0)
                    <div class="amenities-section" style="margin-top: 3.5rem;">
                        <h3 style="font-weight: 700; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 10px;">
                            <span
                                style="width: 4px; height: 24px; background: var(--primary-color); border-radius: 10px; display: inline-block;"></span>
                            {{ __('general.features') }}
                        </h3>
                        <div class="tags-grid">
                            @foreach ($offer->tags as $tag)
                                <div class="tag-item">
                                    <i class="fas fa-star"></i>
                                    <span>{{ $tag }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <div class="booking-card">
                <div class="price-box shadow-lg">
                    @if ($offer->original_price && $offer->original_price > $offer->price)
                        <span class="old-price">{{ number_format($offer->original_price, 0) }} $</span>
                    @endif
                    <span class="amount">{{ number_format($offer->price, 0) }} $</span>
                    <span class="unit">{{ __('general.offer_price') }}</span>
                </div>

                <div class="offer-summary" style="margin-bottom: 1.5rem; color: #64748b; text-align: center;">
                    <p>{{ __('general.book_this_offer_now') }}</p>
                </div>

                @php
                    $message = __('general.whatsapp_inquiry_message') . ': ' . $offer->name . "\n" . __('general.offer_price') . ': ' . $offer->price . "$";
                    $whatsappLink = 'https://wa.me/201068778340?text=' . urlencode($message);
                @endphp

                <a href="{{ $whatsappLink }}" target="_blank" class="whatsapp-btn">
                    <i class="fab fa-whatsapp"></i>
                    {{ __('general.book_now_whatsapp') }}
                </a>
                <p style="text-align: center; color: #94a3b8; font-size: 0.85rem; margin-top: 1.25rem;">
                    <i class="fas fa-info-circle ml-1"></i> {{ __('general.contact_for_details') }}
                </p>
            </div>
        </div>
    </div>
@endsection
