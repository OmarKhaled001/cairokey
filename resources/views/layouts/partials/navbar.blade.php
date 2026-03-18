@php
    $siteName = setting('name', 'Cairo Key');
    $logo = setting('logo');
    $locale = app_locale();
    $otherLang = $locale === 'ar' ? 'en' : 'ar';
@endphp

<nav class="navbar" dir="{{ is_rtl() ? 'rtl' : 'ltr' }}">
    <div class="container navbar-container">

        {{-- Logo --}}
        <a href="{{ route('home') }}" class="nav-logo">
            @if ($logo)
                <img src="{{ asset('storage/' . $logo) }}" alt="{{ $siteName }}" class="nav-logo-img">
            @else
                <span class="nav-logo-text">{{ $siteName }}</span>
            @endif
        </a>

        {{-- Navigation links --}}
        <div class="nav-menu" id="navMenu">

            {{-- Mobile header (logo repeated for slide-in panel) --}}
            <div class="mobile-menu-header">
                <a href="{{ route('home') }}" class="mobile-logo">
                    @if ($logo)
                        <img src="{{ asset('storage/' . $logo) }}" alt="{{ $siteName }}" >
                    @else
                        <span>{{ $siteName }}</span>
                    @endif
                </a>
            </div>

            <a href="{{ route('home') }}" class="nav-link {{ request()->is('/') ? 'active' : '' }}">
                {{ __('general.home') }}
            </a>

            <a href="{{ route('apartments.index') }}"
                class="nav-link {{ request()->is('apartments*') ? 'active' : '' }}">
                {{ __('general.apartments') }}
            </a>

            <a href="{{ route('hotels.index') }}" class="nav-link {{ request()->is('hotels*') ? 'active' : '' }}">
                {{ __('general.hotels') }}
            </a>

            <a href="{{ route('cars.index') }}" class="nav-link {{ request()->is('cars*') ? 'active' : '' }}">
                {{ __('general.cars') }}
            </a>

            <a href="{{ route('services.index') }}" class="nav-link {{ request()->is('services*') ? 'active' : '' }}">
                {{ __('general.services') }}
            </a>

        </div>

        {{-- Actions --}}
        <div class="nav-actions">

            {{-- Language switcher --}}
            <a href="{{ LaravelLocalization::getLocalizedURL($otherLang, null, [], true) }}" class="lang-switcher"
                title="{{ __('general.switch_language') }}">

                <span class="lang-label">{{ strtoupper($otherLang) }}</span>
                <div class="lang-circle">{{ strtoupper(app()->getLocale()) }}</div>
            </a>

            {{-- Mobile hamburger --}}
            <button class="hamburger" id="menuToggle" aria-label="{{ __('general.open_menu') }}" aria-expanded="false"
                aria-controls="navMenu">
                <i class="fas fa-bars" aria-hidden="true"></i>
            </button>

        </div>

    </div>
</nav>

{{-- Overlay (closes menu on outside tap) --}}
<div class="menu-overlay" id="menuOverlay" aria-hidden="true"></div>
