@extends('layouts.master')

@section('name', __('general.offers_available') . ' - ' . __('general.cairo_key'))

@push('styles')

@endpush

@section('content')

    <section class="hero-offers">
        <div class="container text-center">
            <h1 style="font-weight: 800; font-size: 2.5rem; margin-bottom: 0.5rem;">{{ __('general.exclusive_offers') }}</h1>
            <p style="opacity: 0.9;">{{ __('general.best_packages_designed_for_you') }}</p>
        </div>
    </section>

    <div class="container section-padding" style="margin-top: 50px; margin-bottom: 50px;">
        @if ($offers->count() > 0)
            <div class="row">
                @foreach ($offers as $offer)
                    <div class="col-md-4 mb-4">
                        <div class="offer-card">
                            <div class="offer-image">
                                <img src="{{ $offer->cover ? asset('storage/' . $offer->cover) : 'https://placehold.co/600x400?text=Offer' }}"
                                    alt="{{ $offer->name }}">
                                <span class="price-tag">{{ $offer->price }} $</span>
                                @if ($offer->original_price && $offer->original_price > $offer->price)
                                    <span class="old-price-tag">{{ $offer->original_price }} $</span>
                                @endif
                            </div>
                            <div class="p-4 flex-grow-1 d-flex flex-column">
                                <h3 class="fw-bold mb-2">{{ $offer->name }}</h3>
                                <p class="text-muted small mb-3">{{ Str::limit($offer->description, 80) }}</p>

                                <div class="mt-auto d-flex justify-content-between align-items-center">
                                    <a href="{{ route('offers.show', $offer->slug) }}"
                                        class="btn btn-outline-primary w-100 rounded-pill">{{ __('general.details') }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="d-flex justify-content-center mt-4">
                {{ $offers->links() }}
            </div>
        @else
            <div class="text-center py-5">
                <i class="fas fa-gift fa-4x text-muted mb-3"></i>
                <h3 class="text-muted">{{ __('general.no_offers_available') }}</h3>
            </div>
        @endif
    </div>

@endsection
