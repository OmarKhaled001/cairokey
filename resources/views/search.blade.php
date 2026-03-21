@extends('layouts.master')

@section('name', __('search.results_title') . ' - ' . __('general.site_name'))

@push('styles')
    {{-- Styles will be added here if needed --}}
@endpush

@section('content')

    <section class="hero-search">
        <div class="container text-center">
            <h1 style="font-weight: 800; font-size: 2.5rem; margin-bottom: 0.5rem;">
                {{ __('search.results_title') }}
            </h1>
            <p style="opacity: 0.9;">
                {{ __('search.results_showing') }} "{{ request('search') }}"
            </p>
        </div>
    </section>

    <div class="container section-padding">
        <div class="main-layout">
            <main>
                @if ($searchResults->count() > 0)
                    <div class="grid main-search-grid"
                        style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.5rem;">
                        @foreach ($searchResults as $item)
                            @php
                                // تحديد البيانات والروابط ديناميكياً بناءً على نوع الموديل
                                $route = '#';
                                $label = __('search.result_label');
                                $priceLabel = '';
                                $priceValue = 0;
                                $locationText = '';

                                if ($item instanceof \App\Models\Apartment) {
                                    $route = route('apartments.show', $item->slug);
                                    $label = __('apartments.label');
                                    $priceValue = $item->price_per_night;
                                    $priceLabel = __('apartments.per_night');
                                    $locationText = $item->city ?? __('general.site_name');
                                } elseif ($item instanceof \App\Models\Car) {
                                    $route = route('cars.show', $item->slug);
                                    $label = __('cars.label');
                                    $priceValue = $item->price_per_day;
                                    $priceLabel = __('cars.per_day');
                                    $locationText = $item->brand ?? __('general.site_name');
                                } elseif ($item instanceof \App\Models\Hotel) {
                                    $route = route('hotels.show', $item->slug);
                                    $label = __('hotels.label');
                                    $priceValue = $item->price_per_night;
                                    $priceLabel = __('hotels.per_night');
                                    $locationText = $item->city ?? __('general.site_name');
                                } elseif ($item instanceof \App\Models\Service) {
                                    $route = route('services.show', $item->slug);
                                    $label = __('services.label');
                                    $priceValue = $item->price;
                                    $priceLabel = '';
                                    $locationText = $item->city ?? __('general.site_name');
                                }
                            @endphp

                            <div class="search-card">
                                <div class="card-image-wrapper"
                                    style="background-image: url('{{ $item->cover ? asset('storage/' . $item->cover) : 'https://placehold.co/600x400?text=Image' }}');">
                                    <span class="type-badge">{{ $label }}</span>
                                </div>

                                <div style="padding: 1.5rem; display: flex; flex-direction: column; flex-grow: 1;">
                                    <a href="{{ $route }}">
                                        <h3 style="font-weight: 800; font-size: 1.2rem; margin-bottom: 0.5rem;">
                                            {{ $item->name }}
                                        </h3>
                                    </a>

                                    <p style="color: #64748b; font-size: 0.9rem; margin-bottom: 1rem;">
                                        <i class="fas fa-map-marker-alt ml-1"></i>
                                        {{ $locationText }}
                                    </p>

                                    @if($priceValue > 0)
                                    <div class="price-tag" style="margin-bottom: 1rem;">
                                        <span style="font-weight: 700; font-size: 1.1rem; color: var(--primary-color);">
                                            ${{ number_format($priceValue, 0) }}
                                        </span>
                                        @if($priceLabel)
                                            <span style="font-size: 0.85rem; color: #64748b;">
                                                {{ $priceLabel }}
                                            </span>
                                        @endif
                                    </div>
                                    @endif

                                    <div class="d-flex justify-center align-center" style="margin-top: 1rem;">
                                        <a href="{{ $route }}" class="btn btn-primary" style="padding: 0.5rem 1rem;">
                                            {{ __('general.view_details') }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    {{-- Pagination --}}
                    @if (method_exists($searchResults, 'links'))
                        <div class="pagination-wrapper mt-5">
                            {{ $searchResults->appends(request()->all())->links() }}
                        </div>
                    @endif
                @else
                    <div style="text-align: center; padding: 5rem 2rem;">
                        <i class="fas fa-search-minus" style="font-size: 4rem; color: #cbd5e1; margin-bottom: 1.5rem;"></i>
                        <h2 style="font-weight: 800;">{{ __('search.no_results_title') }}</h2>
                        <p class="text-muted">
                            {{ __('search.no_results_message') }} "{{ request('search') }}"{{ __('search.try_other_keywords') }}
                        </p>
                        <a href="{{ url('/') }}" class="btn btn-primary mt-3" style="border-radius: 12px;">
                            {{ __('general.back_to_home') }}
                        </a>
                    </div>
                @endif
            </main>
        </div>
    </div>
@endsection