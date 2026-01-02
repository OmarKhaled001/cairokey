@extends('layouts.master')

@section('name', 'الرئيسية - كايروكي')

@section('content')
    <!-- Hero Section -->
    <section class="hero-section"
        style="
    height: 70vh; 
    background-image: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url({{ asset('assets/images/cover.png') }}); 
    background-size: cover; 
    background-position: center; 
    display: flex; 
    align-items: center; 
    justify-content: center; 
    text-align: center; 
    color: white;">

        <div class="container">
            <h1 style="font-size: 3rem; margin-bottom: 1.5rem;">رحلتك تبدأ هنا</h1>
            <p style="font-size: 1.25rem; margin-bottom: 2rem;">شقق فاخرة وتأجير سيارات فخمة بين يديك.</p>
        </div>
    </section>

    <!-- Search/Filter Section -->
    <div class="container" style="position: relative; margin-top: -50px; z-index: 10;">
        <div
            style="background: var(--bg-light); padding: 2rem; border-radius: var(--radius-lg); box-shadow: var(--card-shadow);">
            <form class="d-flex gap-4" style="flex-wrap: wrap;" action="{{ route('search') }}" method="GET"
                class="search-form">

                <input type="text" name="search" id="search" placeholder="ابحث عن شقة أو سيارة أو فندق او ..."
                    style="flex: 1; padding: 10px; border: 1px solid var(--border-color); border-radius: var(--radius-md);">

                <button type="submit" class="btn btn-primary">بحث</button>
            </form>
        </div>
    </div>

    <!-- Services Section -->
    <section class="section-padding">
        <div class="container">
            <div class="section-title">
                <h2>خدماتنا</h2>
                <p>حلول متكاملة لراحتك ورفاهيتك</p>
            </div>

            <div class="grid grid-cols-4 gap-4 " style="justify-content: center; align-items: center; ">
                <!-- 1. Furnished Apartments -->
                <div class="card text-center"
                    style="padding: 2rem; background: var(--bg-light); border-radius: var(--radius-lg); box-shadow: var(--card-shadow); transition: transform 0.3s;">
                    <i class="fas fa-building"
                        style="font-size: 2.5rem; color: var(--primary-color); margin-bottom: 1rem;"></i>
                    <h3 style="font-size: 1.2rem; margin-bottom: 0.5rem;">شقق مفروشة</h3>
                    <p style="color: var(--text-light); font-size: 0.9rem;">وحدات سكنية راقية ومجهزة بالكامل.</p>
                </div>

                <!-- 2. Hotels -->
                <div class="card text-center"
                    style="padding: 2rem; background: var(--bg-light); border-radius: var(--radius-lg); box-shadow: var(--card-shadow); transition: transform 0.3s;">
                    <i class="fas fa-hotel"
                        style="font-size: 2.5rem; color: var(--primary-color); margin-bottom: 1rem;"></i>
                    <h3 style="font-size: 1.2rem; margin-bottom: 0.5rem;">فنادق</h3>
                    <p style="color: var(--text-light); font-size: 0.9rem;">حجوزات في أرقى الفنادق العالمية.</p>
                </div>

                <!-- 3. Cars -->
                <div class="card text-center"
                    style="padding: 2rem; background: var(--bg-light); border-radius: var(--radius-lg); box-shadow: var(--card-shadow); transition: transform 0.3s;">
                    <i class="fas fa-car" style="font-size: 2.5rem; color: var(--primary-color); margin-bottom: 1rem;"></i>
                    <h3 style="font-size: 1.2rem; margin-bottom: 0.5rem;">سيارات</h3>
                    <p style="color: var(--text-light); font-size: 0.9rem;">أسطول متنوع من السيارات الفاخرة.</p>
                </div>


                <!-- 5. Airport Services -->
                <div class="card text-center"
                    style="padding: 2rem; background: var(--bg-light); border-radius: var(--radius-lg); box-shadow: var(--card-shadow); transition: transform 0.3s;">
                    <i class="fas fa-luggage-cart"
                        style="font-size: 2.5rem; color: var(--primary-color); margin-bottom: 1rem;"></i>
                    <h3 style="font-size: 1.2rem; margin-bottom: 0.5rem;">خدمات مطار</h3>
                    <p style="color: var(--text-light); font-size: 0.9rem;">تسهيل إجراءات السفر والوصول وحجز تذاكر الطيران.
                    </p>
                </div>


            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="section-padding" style="background-color: var(--bg-secondary);">
        <div class="container">
            <div class="grid grid-cols-3 gap-4 text-center">
                <div>
                    <h3 style="font-size: 2.5rem; color: var(--primary-color);">50+</h3>
                    <p>شقة متاحة</p>
                </div>
                <div>
                    <h3 style="font-size: 2.5rem; color: var(--primary-color);">200+</h3>
                    <p>عميل سعيد</p>
                </div>
                <div>
                    <h3 style="font-size: 2.5rem; color: var(--primary-color);">100+</h3>
                    <p>سيارة جاهزة</p>
                </div>
            </div>
        </div>
    </section>

    @if (count($featuredItems) > 0)
        {{-- Featured Items --}}

        <section class="section-padding" style="background: var(--bg-secondary)">
            <div class="container">
                <div class="section-title d-flex justify-between align-center">
                    <h2>العناصر المميزة</h2>
                </div>

                <div class="grid grid-cols-3 gap-4">
                    @foreach ($featuredItems as $item)
                        <div class="card" style="background: white; border-radius: 12px; box-shadow: var(--card-shadow);">
                            <div class="card-image"
                                style="
        background-image: url('{{ $item->cover ? asset('storage/' . $item->cover) : 'https://placehold.co/600x400?text=Image' }}');
     ">

                                @if ($item->featured)
                                    <span class="badge-featured">مميز</span>
                                @endif
                            </div>


                            <div class=" card-body text-center p-3">
                                <h3>{{ $item->name ?? $item->title }}</h3>


                                @php
                                    // تحديد المسار بناءً على نوع الموديل
                                    $route = '#';
                                    if ($item instanceof \App\Models\Apartment) {
                                        $route = route('apartments.show', $item->slug);
                                    } elseif ($item instanceof \App\Models\Hotel) {
                                        $route = route('hotels.show', $item->slug); // أو slug إذا توفر
                                    } elseif ($item instanceof \App\Models\Car) {
                                        $route = route('cars.show', $item->slug);
                                    } elseif ($item instanceof \App\Models\Offer) {
                                        $route = route('offers.show', $item->slug);
                                    } elseif ($item instanceof \App\Models\Service) {
                                        $route = route('services.show', $item->slug);
                                    }
                                @endphp

                                <a href="{{ $route }}" class="btn btn-primary mt-2">عرض التفاصيل</a>
                            </div>

                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @if (count($offers) > 0)
        {{-- Offers --}}
        <section class="section-padding" style="background: var(--bg-light)">
            <div class="container">
                <div class="section-title d-flex justify-between align-center">
                    <h2>العروض الحالية</h2>
                </div>

                <div class="grid grid-cols-3 gap-4">
                    @foreach ($offers as $offer)
                        <div class="card"
                            style="background:white;border-radius:12px;box-shadow:var(--card-shadow);overflow:hidden;">

                            {{-- Image --}}
                            <div class="card-image"
                                style="background-image:url('{{ $offer->cover ? asset('storage/' . $offer->cover) : 'https://placehold.co/600x400?text=Offer' }}');">

                                @if ($offer->featured)
                                    <span class="badge-featured">مميز</span>
                                @endif
                            </div>

                            {{-- Body --}}
                            <div class="card-body p-3 text-center">
                                <h3>{{ $offer->name }}</h3>

                                <p class="text-muted small">
                                    {{ \Illuminate\Support\Str::limit($offer->description, 80) }}
                                </p>

                                {{-- Prices --}}
                                <div class="card-body text-center p-3 price-box">
                                    @if ($offer->original_price)
                                        <span class="old-price">
                                            {{ number_format($offer->original_price, 2) }} ج
                                        </span>
                                    @endif

                                    <span class="new-price">
                                        {{ number_format($offer->price, 2) }} ج
                                    </span>
                                </div>

                                <a href="{{ route('offers.show', $offer->slug) }}" class="btn btn-primary mt-3">
                                    عرض التفاصيل
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
    @if (count($apartments) > 0)
        <!-- Latest Apartments Section -->
        <section class="section-padding">
            <div class="container">
                <div class="section-title d-flex justify-between align-center"
                    style="text-align: right; margin-bottom: 2rem;">
                    <h2>أحدث الشقق</h2>
                    <a href="{{ route('apartments.index') }}" class="btn btn-primary" style="font-size: 0.9rem;">عرض
                        المزيد</a>
                </div>

                <div class="grid grid-cols-3 gap-4">
                    @foreach ($apartments as $apartment)
                        <div
                            style="background: var(--bg-light); border-radius: var(--radius-lg); overflow: hidden; box-shadow: var(--card-shadow);">

                            <div
                                style="height: 230px; background-image: url('{{ $apartment->cover ? asset('storage/' . $apartment->cover) : 'https://placehold.co/600x400?text=Apartment' }}'); background-size: cover; background-position: center;">
                            </div>

                            <div style="padding: 1.5rem;">
                                <h3>{{ $apartment->name }}</h3>

                                <p style="color: var(--text-light); font-size: 0.9rem; margin-bottom: 0.5rem;">
                                    <i class="fas fa-map-marker-alt"></i>
                                    {{ $apartment->city }}
                                </p>

                                <p style="color: var(--text-light); font-size: 0.9rem;">
                                    <i class="fas fa-bed"></i>
                                    {{ $apartment->rooms }} غرف نوم
                                </p>

                                <div class="d-flex justify-center align-center" style="margin-top: 1rem;">

                                    <a href="{{ route('apartments.show', $apartment->slug) }}" class="btn btn-primary"
                                        style="padding: 0.5rem 1rem;">
                                        عرض التفاصيل
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
    @if (count($hotels) > 0)
        <!-- Latest Hotels Section -->
        <section class="section-padding">
            <div class="container">
                <div class="section-title d-flex justify-between align-center"
                    style="text-align: right; margin-bottom: 2rem;">
                    <h2>أحدث الفنادق</h2>
                    <a href="{{ route('hotels.index') }}" class="btn btn-primary" style="font-size: 0.9rem;">عرض
                        المزيد</a>
                </div>

                <div class="grid grid-cols-3 gap-4">
                    @foreach ($hotels as $hotel)
                        <div
                            style="background: var(--bg-light); border-radius: var(--radius-lg); overflow: hidden; box-shadow: var(--card-shadow);">

                            <div
                                style="height: 230px; background-image: url('{{ $hotel->cover ? asset('storage/' . $hotel->cover) : 'https://placehold.co/600x400?text=hotel' }}'); background-size: cover; background-position: center;">
                            </div>

                            <div style="padding: 1.5rem;">
                                <h3 style="margin-bottom: 0.75rem;">{{ $hotel->name }}</h3>

                                <div style="margin-bottom: 0.75rem;">
                                    <x-star-rating :rating="$hotel->average_rating" :reviewsCount="0" :showCount="false" size="sm" />
                                </div>

                                <p style="color: var(--text-light); font-size: 0.9rem; margin-bottom: 0.5rem;">
                                    <i class="fas fa-map-marker-alt"></i>
                                    {{ $hotel->city }}
                                </p>

                                <div class="d-flex justify-between align-center" style="margin-top: 1rem;">
                                    <span style="color: var(--primary-color); font-weight: bold; font-size: 1.1rem;">
                                        ${{ $hotel->price_per_night }} / ليلة
                                    </span>

                                    <a href="{{ route('hotels.show', $hotel->slug) }}" class="btn btn-primary"
                                        style="padding: 0.5rem 1rem;">
                                        التفاصيل
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
    @if (count($cars) > 0)
        <!-- Latest Cars Section -->
        <section class="section-padding" style="background-color: var(--bg-secondary);">
            <div class="container">
                <div class="section-title d-flex justify-between align-center"
                    style="text-align: right; margin-bottom: 2rem;">
                    <h2>أحدث السيارات</h2>
                    <a href="{{ route('cars.index') }}" class="btn btn-primary" style="font-size: 0.9rem;">عرض
                        المزيد</a>
                </div>

                <div class="grid grid-cols-3 gap-4">
                    <!-- Car 1 -->
                    @foreach ($cars as $car)
                        <div
                            style="background: var(--bg-light); border-radius: var(--radius-lg); overflow: hidden; box-shadow: var(--card-shadow);">
                            <div
                                style="height: 250px; background-color: #ddd; background-image: url({{ $car->cover ? asset('storage/' . $car->cover) : 'https://placehold.co/600x400?text=Image' }}); background-size: cover;">
                            </div>
                            <div style="padding: 1.5rem;">
                                <h3>{{ $car->name }}</h3>
                                <p style="color: var(--text-light); font-size: 0.9rem; margin-bottom: 0.5rem;">
                                    {{ $car->model }}
                                    -
                                    {{ $car->year }}</p>
                                <div class="d-flex justify-between align-center" style="margin-top: 1rem;">
                                    <span
                                        style="color: var(--primary-color); font-weight: bold; font-size: 1.1rem;">${{ $car->price_per_day }}
                                        /
                                        يوم</span>
                                    <a href="#" class="btn btn-primary" style="padding: 0.5rem 1rem;">التفاصيل</a>
                                </div>
                            </div>
                        </div>
                    @endforeach


                </div>
            </div>
        </section>
    @endif
    @if (count($services) > 0)
        {{-- Services --}}
        <section class="section-padding" style="background: var(--bg-light)">
            <div class="container">
                <div class="section-title d-flex justify-between align-center">
                    <h2> الخدمات </h2>
                    <a href="{{ route('services.index') }}" class="btn btn-primary">عرض جميع الخدمات</a>
                </div>

                <div class="grid grid-cols-3 gap-4">
                    @foreach ($services as $service)
                        <div class="card"
                            style="background:white;border-radius:12px;box-shadow:var(--card-shadow);overflow:hidden;">

                            {{-- Image --}}
                            <div class="card-image"
                                style="background-image:url('{{ $service->cover ? asset('storage/' . $service->cover) : 'https://placehold.co/600x400?text=Offer' }}');">

                                @if ($service->featured)
                                    <span class="badge-featured">مميز</span>
                                @endif
                            </div>

                            {{-- Body --}}
                            <div class="card-body p-3 text-center">
                                <h3>{{ $service->name }}</h3>

                                <p class="text-muted small">
                                    {{ \Illuminate\Support\Str::limit($service->description, 80) }}
                                </p>

                                <a href="" id="whatsappBook" class="btn btn-primary mt-3">
                                    <i class="fab fa-whatsapp"></i>
                                    تواصل معنا
                                </a>
                            </div>
                        </div>
                        <script>
                            document.getElementById('whatsappBook').addEventListener('click', function(e) {
                                e.preventDefault();
                                var phoneNumber = "+2001068778340";
                                var name = "{{ $service->name }}";


                                window.open('https://wa.me/' + phoneNumber + '?text=' + name, '_blank');
                            });
                        </script>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
@endsection
