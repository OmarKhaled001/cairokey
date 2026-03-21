@extends('layouts.master')

@section('title', __('general.search_results_title') . ' - ' . setting('name', 'Cairo Key'))

@section('content')

    {{-- ── Hero ── --}}
    <section class="hero-search">
        <div class="container text-center">
            <h1 style="font-weight: 800; font-size: 2.5rem; margin-bottom: 0.5rem;">
                {{ __('general.search_results_title') }}
            </h1>
            <p style="opacity: 0.9;">
                {{ __('general.search_results_showing') }}
                "<strong>{{ $query }}</strong>"
            </p>
        </div>
    </section>

    {{-- ── Results ── --}}
    <div class="container section-padding">

        @if ($searchResults->isNotEmpty())

            <div class="grid grid-cols-3">
                @foreach ($searchResults as $item)

                    @php
                        $meta = match($item->search_type) {
                            'apartment' => [
                                'label'    => __('general.apartment_label'),
                                'price'    => $item->price_per_night ?? null,
                                'unit'     => __('general.apartment_per_night'),
                                'location' => $item->city ?? '',
                            ],
                            'hotel' => [
                                'label'    => __('general.hotel_label'),
                                'price'    => $item->price_per_night ?? null,
                                'unit'     => __('general.hotel_per_night'),
                                'location' => $item->city ?? '',
                            ],
                            'car' => [
                                'label'    => __('general.car_label'),
                                'price'    => $item->price_per_day ?? null,
                                'unit'     => __('general.car_per_day'),
                                'location' => $item->brand ?? '',
                            ],
                            'service' => [
                                'label'    => __('general.service_label'),
                                'price'    => $item->price ?? null,
                                'unit'     => '',
                                'location' => $item->city ?? '',
                            ],
                            default => [
                                'label'    => ucfirst($item->search_type ?? ''),
                                'price'    => null,
                                'unit'     => '',
                                'location' => '',
                            ],
                        };
                    @endphp

                    <div class="search-card">

                        {{-- Image --}}
                        <div class="card-image-wrapper"
                             style="background-image: url('{{ $item->cover ? asset('storage/' . $item->cover) : 'https://placehold.co/600x400?text=Image' }}');">
                            <span class="type-badge">{{ $meta['label'] }}</span>
                        </div>

                        {{-- Body --}}
                        <div class="card-body" style="display:flex; flex-direction:column; flex-grow:1;">

                            <a href="{{ $item->detailRoute() }}">
                                <h3 style="font-weight:800; font-size:1.2rem; margin-bottom:0.5rem;">
                                    {{ $item->name }}
                                </h3>
                            </a>

                            @if ($meta['location'])
                                <p style="color:var(--text-light); font-size:0.9rem; margin-bottom:0.75rem;">
                                    <i class="fas fa-map-marker-alt"></i>
                                    {{ $meta['location'] }}
                                </p>
                            @endif

                            @if (($meta['price'] ?? 0) > 0)
                                <p style="font-weight:700; font-size:1.1rem; color:var(--primary-color); margin-bottom:0.5rem;">
                                    {{ number_format($meta['price'], 0) }} {{ __('general.currency') }}
                                    @if ($meta['unit'])
                                        <span style="font-size:0.85rem; color:var(--text-light); font-weight:400;">
                                            {{ $meta['unit'] }}
                                        </span>
                                    @endif
                                </p>
                            @endif

                            <div style="margin-top:auto; padding-top:1rem;">
                                <a href="{{ $item->detailRoute() }}" class="btn btn-primary"
                                   style="padding:0.5rem 1rem;">
                                    {{ __('general.view_details') }}
                                </a>
                            </div>

                        </div>
                    </div>

                @endforeach
            </div>

            @if (method_exists($searchResults, 'links'))
                <div class="pagination-wrapper" style="margin-top:2rem;">
                    {{ $searchResults->appends(request()->all())->links() }}
                </div>
            @endif

        @else

            <div class="empty-state text-center" style="padding:5rem 2rem;">
                <i class="fas fa-search-minus"
                   style="font-size:4rem; color:var(--border-color); margin-bottom:1.5rem; display:block;"></i>
                <h2 style="font-weight:800;">{{ __('general.search_no_results_title') }}</h2>
                <p style="color:var(--text-light); margin:1rem 0 2rem;">
                    {{ __('general.search_no_results_message') }}
                    "<strong>{{ $query }}</strong>"
                    {{ __('general.search_try_other_keywords') }}
                </p>
                <a href="{{ route('home') }}" class="btn btn-primary">
                    {{ __('general.back_to_home') }}
                </a>
            </div>

        @endif

    </div>

@endsection
