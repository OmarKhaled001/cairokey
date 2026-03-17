@extends('layouts.master')

@section('title', __('general.home') . ' - ' . setting('name', 'Cairokey'))

@section('content')

    {{-- ===================== HERO SECTION ===================== --}}
    <section class="hero-wrapper"
        style="position: relative; height: 100vh; overflow: hidden; display: flex; align-items: center;">

        <div class="hero-bg"
            style="position: absolute; top: 0; left: 0; width: 100%; height: 120%;
                background: linear-gradient(to bottom, rgba(23, 59, 83, 0.7), rgba(25, 40, 48, 0.8)),
                url('{{ asset('storage/' . setting('hero_cover', 'assets/images/cover.png')) }}') no-repeat center center;
                background-size: cover; z-index: -1; transform: translateY(0);">
        </div>

        <div class="container relative-z-10">
            <div class="hero-content text-center" style="max-width: 900px; margin: 0 auto;">
                <span class="hero-badge mt-5"
                    style="display: inline-block; padding: 8px 20px; background: rgba(255,255,255,0.1); border: 1px solid rgba(255,255,255,0.2); border-radius: 50px; color: #fff; font-size: 0.9rem; margin-bottom: 2rem; backdrop-filter: blur(5px); opacity: 0; transform: translateY(20px);">
                    ✨ {{ __('general.welcome_to_cairo') }}
                </span>

                <h1 class="hero-title"
                    style="font-size: clamp(2.5rem, 8vw, 5rem); font-weight: 900; color: #fff; line-height: 1.1; margin-bottom: 1.5rem; opacity: 0; transform: translateY(30px);">
                    {{ setting('hero_title') }}
                </h1>

                <p class="hero-subtitle"
                    style="font-size: 1.25rem; color: rgba(255,255,255,0.8); margin-bottom: 3rem; opacity: 0; transform: translateY(30px);">
                    {{ setting('hero_description') }}
                </p>

               <div class="search-container-wrap reveal-hero">
    <div class="search-glass-box-v2">
        <form class="search-main-form" action="{{ route('search') }}" method="GET">
            <div class="search-input-wrapper">
                <i class="fas fa-search search-icon"></i>
                <input type="text" name="search" id="animated-placeholder"
                       placeholder=""
                       class="search-input">
            </div>
            <button type="submit" class="search-button-v2">
                <span>{{ __('general.search') }}</span>
                <i class="fas fa-arrow-left mobile-arrow-icon"></i> </button>
        </form>
    </div>
</div>
            </div>
        </div>

        <div class="scroll-indicator"
            style="position: absolute; bottom: 30px; left: 50%; transform: translateX(-50%); color: #fff; opacity: 0.6;">
            <div class="mouse-wheel"
                style="width: 25px; height: 40px; border: 2px solid #fff; border-radius: 20px; position: relative;">
                <div class="wheel-dot"
                    style="width: 4px; height: 8px; background: #fff; border-radius: 2px; position: absolute; top: 8px; left: 50%; transform: translateX(-50%);">
                </div>
            </div>
        </div>
    </section>

    <section class="services-section section-padding" style="background: #f8fafc; overflow: hidden; padding: 100px 0;">
        <div class="container">
            <div class="services-grid"
                style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 25px;">

                @foreach ([['route' => 'apartments.index', 'icon' => 'fa-building', 'label' => 'furnished_apartments', 'desc' => 'furnished_apartments_desc'], ['route' => 'hotels.index', 'icon' => 'fa-hotel', 'label' => 'hotels', 'desc' => 'hotels_desc'], ['route' => 'cars.index', 'icon' => 'fa-car', 'label' => 'cars', 'desc' => 'cars_desc'], ['route' => 'services.index', 'icon' => 'fa-luggage-cart', 'label' => 'airport_services', 'desc' => 'airport_services_desc']] as $svc)
                    <a href="{{ route($svc['route']) }}" class="service-card-premium"
                        style="opacity: 0; transform: translateY(50px); text-decoration: none; display: block;">

                        <div class="card-inner"
                            style="background: #fff; padding: 40px 25px; border-radius: 24px; text-align: center; height: 100%; border: 1px solid rgba(0,0,0,0.03); box-shadow: 0 10px 30px rgba(0,0,0,0.02); transition: all 0.4s ease;">

                            <div class="icon-circle"
                                style="width: 80px; height: 80px; background: #f1f5f9; color: var(--primary-color); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 25px; font-size: 2rem; transition: 0.5s;">
                                <i class="fas {{ $svc['icon'] }}"></i>
                            </div>

                            <h3 style="font-size: 1.25rem; font-weight: 700; color: #173b53; margin-bottom: 15px;">
                                {{ __('general.' . $svc['label']) }}
                            </h3>

                            <p style="color: #64748b; font-size: 0.95rem; line-height: 1.7;">
                                {{ __('general.' . $svc['desc']) }}
                            </p>
                        </div>
                    </a>
                @endforeach

            </div>
        </div>
    </section>
    {{-- ===================== FEATURED ITEMS ===================== --}}
    @if ($featuredItems->isNotEmpty())
        <section class="section-padding" style="background: var(--bg-secondary);">
            <div class="container">
                <div class="section-title d-flex justify-between align-center">
                    <h2>{{ __('general.featured_items') }}</h2>
                </div>

                <div class="grid grid-cols-3">
                    @foreach ($featuredItems as $item)
                        <div class="apt-card">
                            <div class="apt-image">
                                <img src="{{ $item->cover ? asset('storage/' . $item->cover) : 'https://placehold.co/600x400?text=Image' }}"
                                    alt="{{ $item->name ?? $item->title }}">
                                @if ($item->featured)
                                    <span class="badge-featured">{{ __('general.featured') }}</span>
                                @endif
                            </div>
                            <div class="card-body text-center">
                                <a href="{{ $item->detailRoute() }}">
                                    <h3>{{ $item->name ?? $item->title }}</h3>
                                </a>
                                <a href="{{ $item->detailRoute() }}" class="btn btn-primary" style="margin-top: 0.75rem;">
                                    {{ __('general.view_details') }}
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- ===================== OFFERS ===================== --}}
    @if ($offers->isNotEmpty())
        <section class="section-padding" style="background: var(--bg-light);">
            <div class="container">
                <div class="section-title d-flex justify-between align-center">
                    <h2>{{ __('general.current_offers') }}</h2>
                    <a href="{{ route('offers.index') }}" class="btn btn-primary" style="font-size: 0.9rem;width: auto;">
                        {{ __('general.view_more') }}
                    </a>
                </div>

                <div class="grid grid-cols-3">
                    @foreach ($offers as $offer)
                        <div class="offer-card">
                            <div class="offer-image">
                                <img src="{{ $offer->cover ? asset('storage/' . $offer->cover) : 'https://placehold.co/600x400?text=Offer' }}"
                                    alt="{{ $offer->name }}">
                                @if ($offer->featured)
                                    <span class="badge-featured">{{ __('general.featured') }}</span>
                                @endif
                            </div>

                            <div class="card-body text-center">
                                <a href="{{ route('offers.show', $offer->slug) }}">
                                    <h3>{{ $offer->name }}</h3>
                                </a>

                                <p style="color: var(--text-light); font-size: 0.9rem;">
                                    {{ Str::limit($offer->description, 80) }}
                                </p>

                                <div class="price-box-inline" style="justify-content: center; margin: 0.75rem 0;">
                                    @if ($offer->original_price)
                                        <span class="old-price">
                                            {{ number_format($offer->original_price, 2) }} {{ __('general.currency') }}
                                        </span>
                                    @endif
                                    <span class="new-price">
                                        {{ number_format($offer->price, 2) }} {{ __('general.currency') }}
                                    </span>
                                </div>

                                <a href="{{ route('offers.show', $offer->slug) }}" class="btn btn-primary">
                                    {{ __('general.view_details') }}
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- ===================== LATEST APARTMENTS ===================== --}}
    @if ($apartments->isNotEmpty())
        <section class="section-padding">
            <div class="container">
                <div class="section-title d-flex justify-between align-center">
                    <h2>{{ __('general.latest_apartments') }}</h2>
                    <a href="{{ route('apartments.index') }}" class="btn btn-primary"
                        style="font-size: 0.9rem;width: auto;">
                        {{ __('general.view_more') }}
                    </a>
                </div>

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
            </div>
        </section>
    @endif

    {{-- ===================== LATEST HOTELS ===================== --}}
    @if ($hotels->isNotEmpty())
        <section class="section-padding">
            <div class="container">
                <div class="section-title d-flex justify-between align-center">
                    <h2>{{ __('general.latest_hotels') }}</h2>
                    <a href="{{ route('hotels.index') }}" class="btn btn-primary"
                        style="font-size: 0.9rem;width: auto;">
                        {{ __('general.view_more') }}
                    </a>
                </div>

                <div class="grid grid-cols-3">
                    @foreach ($hotels as $hotel)
                        <div class="apt-card">
                            <div class="apt-image">
                                <img src="{{ $hotel->cover ? asset('storage/' . $hotel->cover) : 'https://placehold.co/600x400?text=Hotel' }}"
                                    alt="{{ $hotel->name }}">
                            </div>
                            <div class="card-body">
                                <a href="{{ route('hotels.show', $hotel->slug) }}">
                                    <h3>{{ $hotel->name }}</h3>
                                </a>
                                <x-star-rating :rating="$hotel->average_rating" :reviewsCount="0" :showCount="false" size="sm" />
                                @if ($hotel->city)
                                    <p style="color: var(--text-light); font-size: 0.9rem; margin: 0.5rem 0;">
                                        <i class="fas fa-map-marker-alt"></i> {{ $hotel->city }}
                                    </p>
                                @endif
                                <a href="{{ route('hotels.show', $hotel->slug) }}" class="btn btn-primary"
                                    style="margin-top: 1rem; padding: 0.5rem 1rem;">
                                    {{ __('general.view_details') }}
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- ===================== LATEST CARS ===================== --}}
    @if ($cars->isNotEmpty())
        <section class="section-padding" style="background: var(--bg-secondary);">
            <div class="container">
                <div class="section-title d-flex justify-between align-center">
                    <h2>{{ __('general.latest_cars') }}</h2>
                    <a href="{{ route('cars.index') }}" class="btn btn-primary" style="font-size: 0.9rem;width: auto;">
                        {{ __('general.view_more') }}
                    </a>
                </div>

                <div class="grid grid-cols-3">
                    @foreach ($cars as $car)
                        <div class="apt-card">
                            <div class="apt-image">
                                <img src="{{ $car->cover ? asset('storage/' . $car->cover) : 'https://placehold.co/600x400?text=Car' }}"
                                    alt="{{ $car->name }}">
                            </div>
                            <div class="card-body">
                                <a href="{{ route('cars.show', $car->slug) }}">
                                    <h3>{{ $car->name }}</h3>
                                </a>
                                <a href="{{ route('cars.show', $car->slug) }}" class="btn btn-primary"
                                    style="margin-top: 1rem; padding: 0.5rem 1rem;">
                                    {{ __('general.view_details') }}
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- ===================== SERVICES ===================== --}}
    @if ($services->isNotEmpty())
        <section class="section-padding" style="background: var(--bg-light);">
            <div class="container">
                <div class="section-title d-flex justify-between align-center">
                    <h2>{{ __('general.services') }}</h2>
                    <a href="{{ route('services.index') }}" class="btn btn-primary"
                        style="font-size: 0.9rem;width: auto;">
                        {{ __('general.view_all_services') }}
                    </a>
                </div>

                <div class="grid grid-cols-3">
                    @foreach ($services as $service)
                        <div class="offer-card">
                            <div class="offer-image">
                                <img src="{{ $service->cover ? asset('storage/' . $service->cover) : 'https://placehold.co/600x400?text=Service' }}"
                                    alt="{{ $service->name }}">
                                @if ($service->featured)
                                    <span class="badge-featured">{{ __('general.featured') }}</span>
                                @endif
                            </div>

                            <div class="card-body text-center">
                                <a href="{{ route('services.show', $service->slug) }}">
                                    <h3>{{ $service->name }}</h3>
                                </a>
                                <p style="color: var(--text-light); font-size: 0.9rem;">
                                    {{ Str::limit($service->description, 80) }}
                                </p>
                                <a href="{{ route('services.show', $service->slug) }}" class="btn btn-primary"
                                    style="margin-top: 0.75rem;">
                                    {{ __('general.view_details') }}
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Register GSAP plugins
            gsap.registerPlugin(ScrollTrigger);

            // ==================== HERO SECTION ANIMATIONS ====================
            function initHeroAnimations() {
                // Hero entrance animations timeline
                const heroTl = gsap.timeline();

                heroTl
                    .to(".hero-badge", {
                        opacity: 1,
                        y: 0,
                        duration: 0.8,
                        ease: "back.out(1.7)"
                    })
                    .to(".hero-title", {
                        opacity: 1,
                        y: 0,
                        duration: 1,
                        ease: "power4.out"
                    }, "-=0.5")
                    .to(".hero-subtitle", {
                        opacity: 1,
                        y: 0,
                        duration: 1,
                        ease: "power3.out"
                    }, "-=0.7")
                    .to(".search-container-wrap", {
                        opacity: 1,
                        scale: 1,
                        duration: 0.8,
                        ease: "elastic.out(1, 0.8)"
                    }, "-=0.6");

                // Smooth parallax effect on scroll
                gsap.to(".hero-bg", {
                    yPercent: 20,
                    ease: "none",
                    scrollTrigger: {
                        trigger: ".hero-wrapper",
                        start: "top top",
                        end: "bottom top",
                        scrub: true
                    }
                });

                // Fade out hero content on scroll
                gsap.to(".hero-content", {
                    opacity: 0,
                    y: -50,
                    scrollTrigger: {
                        trigger: ".hero-wrapper",
                        start: "top top",
                        end: "center top",
                        scrub: true
                    }
                });
            }

            // ==================== SERVICES SECTION ANIMATIONS ====================
            function initServicesAnimations() {
                // Services section header animation
                gsap.to(".section-header", {
                    opacity: 1,
                    y: 0,
                    duration: 1,
                    scrollTrigger: {
                        trigger: ".services-section",
                        start: "top 80%",
                        toggleActions: "play none none none"
                    }
                });

                // Stagger animation for service cards
                gsap.to(".service-card-premium", {
                    opacity: 1,
                    y: 0,
                    duration: 1,
                    stagger: 0.15, // Cards appear one after another with 0.15s delay
                    ease: "power4.out",
                    scrollTrigger: {
                        trigger: ".services-grid",
                        start: "top 85%",
                        toggleActions: "play none none none"
                    }
                });

                // Alternative/Better approach: Combined animation for all service cards
                gsap.to(".service-card-premium", {
                    opacity: 1,
                    y: 0,
                    duration: 0.8,
                    stagger: 0.2, // Larger stagger for more dramatic effect
                    ease: "power2.out",
                    scrollTrigger: {
                        trigger: ".services-section",
                        start: "top 70%",
                        toggleActions: "play none none none"
                    }
                });
            }

            // ==================== FEATURED ITEMS ANIMATIONS ====================
            function initFeaturedItemsAnimations() {
                gsap.from(".apt-card, .offer-card", {
                    opacity: 0,
                    y: 50,
                    duration: 0.8,
                    stagger: 0.1,
                    scrollTrigger: {
                        trigger: ".grid",
                        start: "top 80%",
                        toggleActions: "play none none none"
                    }
                });
            }

            // ==================== SECTION TITLES ANIMATIONS ====================
            function initSectionTitlesAnimations() {
                gsap.from(".section-title h2", {
                    opacity: 0,
                    x: -30,
                    duration: 0.8,
                    scrollTrigger: {
                        trigger: ".section-title",
                        start: "top 85%",
                        toggleActions: "play none none none"
                    }
                });

                gsap.from(".section-title .btn", {
                    opacity: 0,
                    x: 30,
                    duration: 0.8,
                    scrollTrigger: {
                        trigger: ".section-title",
                        start: "top 85%",
                        toggleActions: "play none none none"
                    }
                });
            }

            // ==================== SCROLL INDICATOR ANIMATION ====================
            function initScrollIndicator() {
                // Continuous animation for mouse wheel
                gsap.to(".wheel-dot", {
                    y: 15,
                    duration: 1.5,
                    repeat: -1,
                    yoyo: true,
                    ease: "power1.inOut"
                });
            }

            // ==================== LAZY LOADING ANIMATIONS ====================
            // Only initialize animations when elements exist on page
            if (document.querySelector(".hero-wrapper")) initHeroAnimations();
            if (document.querySelector(".services-section")) initServicesAnimations();
            if (document.querySelector(".grid")) initFeaturedItemsAnimations();
            if (document.querySelector(".section-title")) initSectionTitlesAnimations();
            if (document.querySelector(".wheel-dot")) initScrollIndicator();

            // ==================== RTL SUPPORT FOR ANIMATIONS ====================
            // Adjust animations based on document direction
            const isRTL = document.documentElement.dir === 'rtl' || document.body.classList.contains('rtl');

            if (isRTL) {
                // Reverse X-axis animations for RTL
                gsap.utils.toArray('.section-title h2').forEach(el => {
                    gsap.set(el, {
                        x: 30
                    });
                });

                gsap.utils.toArray('.section-title .btn').forEach(el => {
                    gsap.set(el, {
                        x: -30
                    });
                });
            }

            // ==================== PERFORMANCE OPTIMIZATIONS ====================
            // Reduce animation intensity for users who prefer reduced motion
            const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

            if (prefersReducedMotion) {
                // Disable all GSAP animations
                gsap.globalTimeline.clear();

                // Set all animated elements to visible state
                gsap.set([".hero-badge", ".hero-title", ".hero-subtitle",
                    ".search-container-wrap", ".service-card-premium"
                ], {
                    opacity: 1,
                    y: 0,
                    scale: 1
                });
            }

            // ==================== CLEANUP ON PAGE HIDE ====================
            // Kill all ScrollTriggers when page is hidden to prevent memory leaks
            document.addEventListener('visibilitychange', function() {
                if (document.hidden) {
                    ScrollTrigger.getAll().forEach(trigger => trigger.kill());
                }
            });
        });
    </script>
    <script>
document.addEventListener("DOMContentLoaded", function() {
    const input = document.getElementById('animated-placeholder');
    // الكلمات اللي هتظهر في البليس هولدر (تقدر تسحبهم من ملفات اللغة)
    const messages = [
        "{{ __('general.search_apartments') }}...",
        "{{ __('general.search_hotels') }}...",
        "{{ __('general.search_cars') }}...",
        "{{ __('general.search_placeholder') }}..."
    ];

    let messageIndex = 0;
    let characterIndex = 0;
    let currentMessage = '';
    let isDeleting = false;
    let typeSpeed = 100;

    function type() {
        currentMessage = messages[messageIndex];

        if (isDeleting) {
            input.placeholder = currentMessage.substring(0, characterIndex--);
            typeSpeed = 50; // سرعة المسح أسرع
        } else {
            input.placeholder = currentMessage.substring(0, characterIndex++);
            typeSpeed = 100; // سرعة الكتابة
        }

        if (!isDeleting && characterIndex === currentMessage.length + 1) {
            isDeleting = true;
            typeSpeed = 2000; // وقت الانتظار لما يخلص كتابة الجملة
        } else if (isDeleting && characterIndex === 0) {
            isDeleting = false;
            messageIndex = (messageIndex + 1) % messages.length;
            typeSpeed = 500;
        }

        setTimeout(type, typeSpeed);
    }

    type();
});
</script>
@endsection
