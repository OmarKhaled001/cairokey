@extends('layouts.master')

@section('name', __('general.cars_available') . ' - ' . __('general.cairo_key'))

@push('styles')

@endpush

@section('content')

    <section class="hero-cars">
        <div class="container text-center">
            <h1 style="font-weight: 800; font-size: 2.5rem; margin-bottom: 0.5rem;">{{ __('general.our_luxury_fleet') }}</h1>
            <p style="opacity: 0.9;">{{ __('general.choose_your_perfect_car') }}</p>
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
                <form action="{{ route('cars.index') }}" method="GET" class="filter-sidebar">

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
                        <label>{{ __('general.brand') }}</label>
                        <select name="brand" class="form-control-custom">
                            <option value="">{{ __('general.all_brands') }}</option>
                            @foreach ($brands as $brand)
                                <option value="{{ $brand }}" {{ request('brand') == $brand ? 'selected' : '' }}>
                                    {{ $brand }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="filter-group">
                        <label>{{ __('general.price_range_per_day') }}</label>
                        <div class="price-range-container" style="padding: 10px 5px 30px;">
                            <input type="range" id="priceRange" min="{{ $minAvailablePrice }}"
                                max="{{ $maxAvailablePrice }}" value="{{ request('price_max', $maxAvailablePrice) }}"
                                class="modern-range" oninput="updatePriceLabel(this.value)">

                            <div
                                style="display: flex; justify-content: space-between; margin-top: 15px; font-size: 0.85rem; font-weight: 700;">
                                <span>${{ $minAvailablePrice }}</span>
                                <span class="text-primary">{{ __('general.up_to') }} <span
                                        id="currentPriceLabel">{{ request('price_max', $maxAvailablePrice) }}</span></span>
                            </div>

                            <input type="hidden" name="price_min" value="{{ $minAvailablePrice }}">
                            <input type="hidden" name="price_max" id="price_max_hidden"
                                value="{{ request('price_max', $maxAvailablePrice) }}">
                        </div>
                    </div>

                    <div class="filter-group">
                        <label>{{ __('general.sort_by') }}</label>
                        <select name="sort" class="form-control-custom">
                            <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>{{ __('general.newest_first') }}
                            </option>
                            <option value="lowest_price" {{ request('sort') == 'lowest_price' ? 'selected' : '' }}>{{ __('general.price_lowest_first') }}</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary "
                        style="padding: 0.8rem; border-radius: 12px; font-weight: 700;">
                        {{ __('general.apply_filter') }}
                    </button>

                    @if (request()->anyFilled(['brand', 'price_min', 'price_max', 'sort']))
                        <a href="{{ route('cars.index') }}"
                            style="display: block; text-align: center; margin-top: 1rem; color: #64748b; font-size: 0.8rem;">
                            {{ __('general.reset') }}
                        </a>
                    @endif
                </form>
            </aside>

            <main>
                @if ($cars->count() > 0)
                    <div class="grid grid-cols-3 gap-4">
                        @foreach ($cars as $car)
                            <div
                                style="background: var(--bg-light); border-radius: var(--radius-lg); overflow: hidden; box-shadow: var(--card-shadow);">
                                <div
                                    style="height: 250px; background-color: #ddd; background-image: url({{ $car->cover ? asset('storage/' . $car->cover) : 'https://placehold.co/600x400?text=Image' }}); background-size: cover;">
                                </div>
                                <div style="padding: 1.5rem;">
                                    <a href="{{ route('cars.show', $car) }}">
                                        <h3>{{ $car->name }}</h3>
                                    </a>
                                    <div class="d-flex justify-between align-center" style="margin-top: 1rem;">
                                        <a href="{{ route('cars.show', $car) }}" class="btn btn-primary"
                                            style="padding: 0.5rem 1rem;">{{ __('general.view_details') }}</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="pagination-wrapper">
                        {{ $cars->links() }}
                    </div>
                @else
                    <div class="empty-state"
                        style="text-align: center; padding: 4rem 2rem; background: white; border-radius: 20px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);">
                        <div style="margin-bottom: 2rem;">
                            <i class="fas fa-search" style="font-size: 5rem; color: #cbd5e1; opacity: 0.5;"></i>
                        </div>

                        <h3
                            style="font-size: 1.8rem; font-weight: 700; color: var(--secondary-color); margin-bottom: 1rem;">
                            {{ __('general.no_cars_found') }}
                        </h3>

                        <p
                            style="font-size: 1.1rem; color: #64748b; margin-bottom: 2rem; max-width: 500px; margin-left: auto; margin-right: auto;">
                            {{ __('general.no_cars_match_criteria') }}
                        </p>

                        <a href="{{ route('cars.index') }}" class="btn btn-primary"
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
        });
    </script>
@endsection
