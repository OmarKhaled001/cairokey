@extends('layouts.master')

@section('title', __('general.discover_your_next_escape') . ' — ' . setting('name', 'Cairo Key'))

@section('content')

    {{-- ── Hero ──────────────────────────────────────────────────────── --}}
    <section class="hero-hotels">
        <div class="container text-center">
            <h1 style="font-weight: 800; font-size: 3rem;">
                {{ __('general.discover_your_next_escape') }}
            </h1>
            <p style="opacity: 0.9;">{{ __('general.best_carefully_selected_apartments') }}</p>
        </div>
    </section>

    {{-- ── Mobile filter overlay & toggle ─────────────────────────────── --}}
    <div class="filter-overlay" id="filterOverlay"></div>

    <button class="mobile-filter-toggle" id="filterToggle" aria-expanded="false" aria-controls="filterSidebar">
        <i class="fas fa-filter" aria-hidden="true"></i>
        <span>{{ __('general.filters') }}</span>
    </button>

    {{-- ── Main layout ──────────────────────────────────────────────────── --}}
    <div class="container section-padding">
        <div class="grid main-layout" style="grid-template-columns: 300px 1fr; gap: 2.5rem;">

            {{-- ── Filter sidebar ───────────────────────────────────────── --}}
            <aside id="filterSidebar" aria-label="{{ __('general.filter_results') }}">
                <form action="{{ route('apartments.index') }}" method="GET" class="filter-sidebar">

                    {{-- Header (single element, CSS handles mobile/desktop visibility) --}}
                    <div class="filter-header">
                        <h4>
                            <i class="fas fa-filter" aria-hidden="true"></i>
                            {{ __('general.filter_results') }}
                        </h4>
                        <button type="button" class="close-filter-btn d-mobile-only" id="filterClose"
                            aria-label="{{ __('general.close') }}">
                            <i class="fas fa-times" aria-hidden="true"></i>
                        </button>
                    </div>

                    {{-- City --}}
                    <div class="filter-group">
                        <label for="filter-city">{{ __('general.city') }}</label>
                        <select id="filter-city" name="city" class="form-control-custom">
                            <option value="">{{ __('general.all_cities') }}</option>
                            @foreach ($cities as $city)
                                <option value="{{ $city }}" @selected(request('city') === $city)>
                                    {{ $city }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Price range --}}
                    <div class="filter-group">
                        <label for="priceRange">{{ __('general.price_range_per_night') }}</label>
                        <div style="padding: 10px 5px 30px;">
                            <input type="range" id="priceRange" min="{{ $minAvailablePrice }}"
                                max="{{ $maxAvailablePrice }}" value="{{ request('price_max', $maxAvailablePrice) }}"
                                class="modern-range">

                            <div class="d-flex justify-between"
                                style="margin-top: 15px; font-size: 0.85rem; font-weight: 700;">
                                <span>{{ number_format($minAvailablePrice) }} {{ __('general.currency') }}</span>
                                <span style="color: var(--primary-color);">
                                    {{ __('general.up_to') }}
                                    <span id="currentPriceLabel">
                                        {{ number_format(request('price_max', $maxAvailablePrice)) }}
                                    </span>
                                    $
                                </span>
                            </div>

                            <input type="hidden" name="price_min" value="{{ $minAvailablePrice }}">
                            <input type="hidden" name="price_max" id="price_max_hidden"
                                value="{{ request('price_max', $maxAvailablePrice) }}">
                        </div>
                    </div>

                    {{-- Sort --}}
                    <div class="filter-group">
                        <label for="filter-sort">{{ __('general.sort_by') }}</label>
                        <select id="filter-sort" name="sort" class="form-control-custom">
                            <option value="newest" @selected(request('sort') === 'newest')>
                                {{ __('general.newest_first') }}
                            </option>
                            <option value="highest_rated" @selected(request('sort') === 'highest_rated')>
                                {{ __('general.highest_rated') }}
                            </option>
                            <option value="lowest_price" @selected(request('sort') === 'lowest_price')>
                                {{ __('general.price_lowest_first') }}
                            </option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary"
                        style="width: 100%; padding: 0.8rem; border-radius: 12px; font-weight: 700;">
                        {{ __('general.apply_filter') }}
                    </button>

                    @if (request()->anyFilled(['city', 'price_min', 'price_max', 'sort']))
                        <a href="{{ route('apartments.index') }}"
                            style="display: block; text-align: center; margin-top: 1rem; color: var(--text-light); font-size: 0.85rem;">
                            {{ __('general.reset') }}
                        </a>
                    @endif

                </form>
            </aside>

            {{-- ── Listings ──────────────────────────────────────────────── --}}
            <main>
                @if ($apartments->isNotEmpty())
                    <div class="grid grid-cols-3">
                        @foreach ($apartments as $apartment)
                             <div class="apt-card">
                            <div class="apt-image">
                                <img src="{{ $apartment->cover ? asset('storage/' . $apartment->cover) : 'https://placehold.co/600x400?text=Apartment' }}"
                                     alt="{{ $apartment->name }}">
                            </div>
                            <div class="card-body">
                                <a href="{{ route('apartments.show', $apartment->slug) }}">
                                    <h3>{{ $apartment->name }}</h3>
                                </a>
                                @if ($apartment->city)
                                    <p style="color: var(--text-light); font-size: 0.9rem; margin: 0.5rem 0;">
                                        <i class="fas fa-map-marker-alt"></i> {{ $apartment->city }}
                                    </p>
                                @endif
                                <a href="{{ route('apartments.show', $apartment->slug) }}" class="btn btn-primary"
                                   style="margin-top: 1rem; padding: 0.5rem 1rem;">
                                    {{ __('general.view_details') }}
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <div class="pagination-wrapper">
                        {{ $apartments->links() }}
                    </div>
                @else
                    <div class="empty-state" style="text-align: center; padding: 4rem 2rem;">
                        <i class="fas fa-search" style="font-size: 5rem; color: var(--border-color);"
                            aria-hidden="true"></i>

                        <h3
                            style="font-size: 1.8rem; font-weight: 700; color: var(--secondary-color); margin: 1.5rem 0 1rem;">
                            {{ __('general.no_apartments_found') }}
                        </h3>

                        <p
                            style="font-size: 1.1rem; color: var(--text-light); margin-bottom: 2rem; max-width: 500px; margin-inline: auto;">
                            {{ __('general.no_apartments_match_criteria') }}
                        </p>

                        <a href="{{ route('apartments.index') }}" class="btn btn-primary"
                            style="padding: 0.875rem 2rem; border-radius: 12px; font-weight: 700;">
                            <i class="fas fa-redo" aria-hidden="true"></i>
                            {{ __('general.reset_filters') }}
                        </a>
                    </div>
                @endif
            </main>

        </div>
    </div>

@endsection

@push('styles')
    <style>
        /* Show close button only on mobile */
        .d-mobile-only {
            display: none;
        }

        /* Single filter header — desktop shows title only, mobile adds close button */
        .filter-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid var(--bg-secondary);
        }

        .filter-header h4 {
            margin: 0;
            font-weight: 800;
            display: flex;
            align-items: center;
            gap: 10px;
            color: var(--secondary-color);
        }

        @media (max-width: 768px) {
            .d-mobile-only {
                display: flex;
            }
        }
    </style>
@endpush

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            /* ── Filter sidebar open / close ─────────────────────────── */
            const sidebar = document.getElementById('filterSidebar');
            const overlay = document.getElementById('filterOverlay');
            const openBtn = document.getElementById('filterToggle');
            const closeBtn = document.getElementById('filterClose');

            function openFilter() {
                sidebar?.classList.add('active');
                overlay?.classList.add('active');
                document.body.classList.add('menu-open');
                openBtn?.setAttribute('aria-expanded', 'true');
            }

            function closeFilter() {
                sidebar?.classList.remove('active');
                overlay?.classList.remove('active');
                document.body.classList.remove('menu-open');
                openBtn?.setAttribute('aria-expanded', 'false');
            }

            openBtn?.addEventListener('click', openFilter);
            closeBtn?.addEventListener('click', closeFilter);
            overlay?.addEventListener('click', closeFilter);

            document.addEventListener('keydown', e => {
                if (e.key === 'Escape') closeFilter();
            });

            /* ── Price range label sync ──────────────────────────────── */
            const range = document.getElementById('priceRange');
            const label = document.getElementById('currentPriceLabel');
            const hiddenMax = document.getElementById('price_max_hidden');

            range?.addEventListener('input', function() {
                const formatted = Number(this.value).toLocaleString('{{ app_locale() }}');
                if (label) label.textContent = formatted;
                if (hiddenMax) hiddenMax.value = this.value;
            });
        });
    </script>
@endpush
