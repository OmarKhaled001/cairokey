@extends('layouts.master')

@section('name', __('general.hotels_available') . ' - ' . __('general.cairo_key'))

@push('styles')
@endpush

@section('content')

    <section class="hero-hotels">
        <div class="container text-center">
            <h1 style="font-weight: 800; font-size: 3rem;">{{ __('general.discover_your_next_escape') }}</h1>
            <p style="opacity: 0.9;">{{ __('general.best_carefully_selected_apartments') }}</p>
        </div>
    </section>

    <div class="filter-overlay" id="filterOverlay" onclick="closeFilter()"></div>

    <button class="mobile-filter-toggle" onclick="openFilter()">
        <i class="fas fa-filter"></i>
        <span>{{ __('general.filters') }}</span>
    </button>

    <div class="container section-padding">
        <div class="grid main-layout" style="grid-template-columns: 300px 1fr; gap: 2.5rem; display: grid;">

            <aside id="filterSidebar">
                <form action="{{ route('hotels.index') }}" method="GET" class="filter-sidebar">

                    <div class="filter-mobile-header" style="display: none;">
                        <h4>
                            <i class="fas fa-filter text-primary"></i>
                            {{ __('general.filter_results') }}
                        </h4>
                        <button type="button" class="close-filter-btn" onclick="closeFilter()">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>

                    <h4 class="desktop-filter-header"
                        style="font-weight: 800; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 10px;">
                        <i class="fas fa-filter text-primary"></i> {{ __('general.filter_results') }}
                    </h4>

                    <div class="filter-group">
                        <label>{{ __('general.city') }}</label>
                        <select name="city" class="form-control-custom">
                            <option value="">{{ __('general.all_cities') }}</option>
                            @foreach ($cities as $city)
                                <option value="{{ $city }}" {{ request('city') == $city ? 'selected' : '' }}>
                                    {{ $city }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="filter-group">
                        <label>
                            <i class="fas fa-star" style="color: var(--primary-color);"></i>
                            {{ __('general.rating') }}
                        </label>
                        <div class="rating-filter-options">
                            <label class="rating-filter-option {{ !request('rating') ? 'selected' : '' }}">
                                <input type="radio" name="rating" value=""
                                    {{ !request('rating') ? 'checked' : '' }}>
                                <div class="stars">
                                    <i class="fas fa-star" style="color: #94a3b8;"></i>
                                </div>
                                <span class="label">{{ __('general.all_ratings') }}</span>
                            </label>

                            <label class="rating-filter-option {{ request('rating') == '5' ? 'selected' : '' }}">
                                <input type="radio" name="rating" value="5"
                                    {{ request('rating') == '5' ? 'checked' : '' }}>
                                <div class="stars">
                                    <i class="fas fa-star" style="color: var(--primary-color);"></i>
                                    <i class="fas fa-star" style="color: var(--primary-color);"></i>
                                    <i class="fas fa-star" style="color: var(--primary-color);"></i>
                                    <i class="fas fa-star" style="color: var(--primary-color);"></i>
                                    <i class="fas fa-star" style="color: var(--primary-color);"></i>
                                </div>
                                <span class="label">{{ __('general.stars_5') }}</span>
                            </label>

                            <label class="rating-filter-option {{ request('rating') == '4' ? 'selected' : '' }}">
                                <input type="radio" name="rating" value="4"
                                    {{ request('rating') == '4' ? 'checked' : '' }}>
                                <div class="stars">
                                    <i class="fas fa-star" style="color: var(--primary-color);"></i>
                                    <i class="fas fa-star" style="color: var(--primary-color);"></i>
                                    <i class="fas fa-star" style="color: var(--primary-color);"></i>
                                    <i class="fas fa-star" style="color: var(--primary-color);"></i>
                                    <i class="far fa-star" style="color: #E0E0E0;"></i>
                                </div>
                                <span class="label">{{ __('general.stars_4_plus') }}</span>
                            </label>

                            <label class="rating-filter-option {{ request('rating') == '3' ? 'selected' : '' }}">
                                <input type="radio" name="rating" value="3"
                                    {{ request('rating') == '3' ? 'checked' : '' }}>
                                <div class="stars">
                                    <i class="fas fa-star" style="color: var(--primary-color);"></i>
                                    <i class="fas fa-star" style="color: var(--primary-color);"></i>
                                    <i class="fas fa-star" style="color: var(--primary-color);"></i>
                                    <i class="far fa-star" style="color: #E0E0E0;"></i>
                                    <i class="far fa-star" style="color: #E0E0E0;"></i>
                                </div>
                                <span class="label">{{ __('general.stars_3_plus') }}</span>
                            </label>
                        </div>
                    </div>

                    <div class="filter-group">
                        <label>{{ __('general.sort_by') }}</label>
                        <select name="sort" class="form-control-custom">
                            <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>
                                {{ __('general.newest_first') }}
                            </option>
                            <option value="highest_rated" {{ request('sort') == 'highest_rated' ? 'selected' : '' }}>
                                {{ __('general.highest_rated') }}
                            </option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary "
                        style="padding: 0.8rem; border-radius: 12px; font-weight: 700;">
                        {{ __('general.apply_filter') }}
                    </button>

                    @if (request()->anyFilled(['governorate', 'city', 'price_min', 'price_max', 'rating', 'sort']))
                        <a href="{{ route('hotels.index') }}"
                            style="display: block; text-align: center; margin-top: 1rem; color: #64748b; font-size: 0.8rem;">
                            {{ __('general.reset') }}
                        </a>
                    @endif
                </form>
            </aside>

            <main>
                @if ($hotels->count() > 0)
                    <div class="grid grid-cols-3 gap-4">
                        @foreach ($hotels as $hotel)
                            <div
                                style="background: var(--bg-light); border-radius: var(--radius-lg); overflow: hidden; box-shadow: var(--card-shadow);">

                                <div
                                    style="height: 230px; background-image: url('{{ $hotel->cover ? asset('storage/' . $hotel->cover) : 'https://placehold.co/600x400?text=hotel' }}'); background-size: cover; background-position: center;">
                                </div>

                                <div style="padding: 1.5rem;">
                                    <a href="{{ route('hotels.show', $hotel->slug) }}">
                                        <h3 style="margin-bottom: 0.75rem;">{{ $hotel->name }}</h3>
                                    </a>

                                    <div style="margin-bottom: 0.75rem;">
                                        <x-star-rating :rating="$hotel->average_rating" :reviewsCount="0" :showCount="false"
                                            size="sm" />
                                    </div>

                                    <p style="color: var(--text-light); font-size: 0.9rem; margin-bottom: 0.5rem;">
                                        <i class="fas fa-map-marker-alt"></i>
                                        {{ $hotel->city }}
                                    </p>

                                    <div class="d-flex justify-between align-center" style="margin-top: 1rem;">
                                        <a href="{{ route('hotels.show', $hotel->slug) }}" class="btn btn-primary"
                                            style="padding: 0.5rem 1rem;">
                                            {{ __('general.view_details') }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="pagination-wrapper">
                        {{ $hotels->links() }}
                    </div>
                @else
                    <div class="empty-state"
                        style="text-align: center; padding: 4rem 2rem; background: white; border-radius: 20px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);">
                        <div style="margin-bottom: 2rem;">
                            <i class="fas fa-search" style="font-size: 5rem; color: #cbd5e1; opacity: 0.5;"></i>
                        </div>

                        <h3
                            style="font-size: 1.8rem; font-weight: 700; color: var(--secondary-color); margin-bottom: 1rem;">
                            {{ __('general.no_hotels_found') }}
                        </h3>

                        <p
                            style="font-size: 1.1rem; color: #64748b; margin-bottom: 2rem; max-width: 500px; margin-left: auto; margin-right: auto;">
                            {{ __('general.no_hotels_match_criteria') }}
                        </p>

                        <a href="{{ route('hotels.index') }}" class="btn btn-primary"
                            style="padding: 0.875rem 2rem; border-radius: 12px; font-weight: 700; display: inline-flex; align-items: center; gap: 8px; text-decoration: none;">
                            <i class="fas fa-redo"></i>
                            <span>{{ __('general.reset_filters') }}</span>
                        </a>
                    </div>
                @endif
            </main>
        </div>
    </div>

    <script>
        function updatePriceLabel(val) {
            document.getElementById('currentPriceLabel').innerText = val;
            document.getElementById('price_max_hidden').value = val;
        }

        function openFilter() {
            document.getElementById('filterSidebar').classList.add('active');
            document.getElementById('filterOverlay').classList.add('active');
            document.body.style.overflow = 'hidden';

            if (window.innerWidth <= 768) {
                document.querySelector('.filter-mobile-header').style.display = 'flex';
                document.querySelector('.desktop-filter-header').style.display = 'none';
            }
        }

        function closeFilter() {
            document.getElementById('filterSidebar').classList.remove('active');
            document.getElementById('filterOverlay').classList.remove('active');
            document.body.style.overflow = '';
        }

        window.addEventListener('resize', function() {
            if (window.innerWidth > 768) {
                closeFilter();
                document.querySelector('.filter-mobile-header').style.display = 'none';
                document.querySelector('.desktop-filter-header').style.display = 'flex';
            }
        });

        document.addEventListener('DOMContentLoaded', function() {
            if (window.innerWidth <= 768) {
                document.querySelector('.filter-mobile-header').style.display = 'none';
            }

            const ratingOptions = document.querySelectorAll('.rating-filter-option');
            ratingOptions.forEach(option => {
                option.addEventListener('click', function() {
                    ratingOptions.forEach(opt => opt.classList.remove('selected'));
                    this.classList.add('selected');
                    this.querySelector('input[type="radio"]').checked = true;
                });
            });
        });
    </script>
@endsection
