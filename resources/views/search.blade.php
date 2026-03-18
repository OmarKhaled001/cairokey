@extends('layouts.master')

@section('name', 'نتائج البحث - كايرو كي')

@push('styles')

@endpush

@section('content')

    <section class="hero-search">
        <div class="container text-center">
            <h1 style="font-weight: 800; font-size: 2.5rem; margin-bottom: 0.5rem;">نتائج البحث</h1>
            <p style="opacity: 0.9;">أظهرت النتائج "{{ request('search') }}"</p>
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
                                $label = 'نتيجة';
                                $priceLabel = '';
                                $priceValue = 0;

                                if ($item instanceof \App\Models\Apartment) {
                                    $route = route('apartments.show', $item->slug);
                                    $label = 'شقة';
                                    $priceValue = $item->price_per_night;
                                    $priceLabel = '/ ليلة';
                                } elseif ($item instanceof \App\Models\Car) {
                                    $route = route('cars.show', $item->slug);
                                    $label = 'سيارة';
                                    $priceValue = $item->price_per_day;
                                    $priceLabel = '/ يوم';
                                } elseif ($item instanceof \App\Models\Hotel) {
                                    $route = route('hotels.show', $item->slug);
                                    $label = 'فندق';
                                    $priceValue = $item->price_per_night;
                                    $priceLabel = '/ ليلة';
                                } elseif ($item instanceof \App\Models\Service) {
                                    $route = route('services.show', $item->slug);
                                    $label = 'خدمة';
                                    $priceValue = $item->price;
                                    $priceLabel = '';
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
                                            {{ $item->name }}</h3>
                                    </a>

                                    <p style="color: #64748b; font-size: 0.9rem; margin-bottom: 1rem;">
                                        <i class="fas fa-map-marker-alt ml-1"></i>
                                        {{ $item->city ?? ($item->brand ?? 'كايرو كي') }}
                                    </p>


                                    <div class="d-flex justify-center align-center" style="margin-top: 1rem;">

                                        <a href="{{ $route }}" class="btn btn-primary" style="padding: 0.5rem 1rem;">
                                            عرض التفاصيل
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    {{-- الـ Pagination لو استخدمت SimplePaginate أو Manual --}}
                    @if (method_exists($searchResults, 'links'))
                        <div class="pagination-wrapper mt-5">
                            {{ $searchResults->appends(request()->all())->links() }}
                        </div>
                    @endif
                @else
                    <div style="text-align: center; padding: 5rem 2rem;">
                        <i class="fas fa-search-minus" style="font-size: 4rem; color: #cbd5e1; margin-bottom: 1.5rem;"></i>
                        <h2 style="font-weight: 800;">لا توجد نتائج!</h2>
                        <p class="text-muted">لم نجد أي نتائج تطابق "{{ request('search') }}"، جرب كلمات أخرى.</p>
                        <a href="{{ url('/') }}" class="btn btn-primary mt-3" style="border-radius: 12px;">العودة
                            للرئيسية</a>
                    </div>
                @endif
            </main>
        </div>
    </div>
@endsection
