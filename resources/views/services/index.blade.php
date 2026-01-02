@extends('layouts.master')

@section('name', 'خدماتنا - كايرو كي')

@push('styles')
    <style>
        /* الحفاظ على نمط الكروت الموحد */
        .search-card {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            transition: all 0.3s ease;
            border: 1px solid #f1f5f9;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .search-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
        }

        .card-image-wrapper {
            height: 230px;
            position: relative;
            background-size: cover;
            background-position: center;
        }

        .type-badge {
            position: absolute;
            top: 15px;
            right: 15px;
            background: var(--primary-color);
            color: white;
            padding: 5px 15px;
            border-radius: 50px;
            font-weight: 800;
            font-size: 0.8rem;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            z-index: 10;
        }

        /* تنسيق الـ Grid للموبايل */
        @media (max-width: 768px) {
            .main-search-grid {
                grid-template-columns: 1fr !important;
            }

            .hero-search {
                height: 25vh !important;
            }
        }

        .hero-search {
            height: 30vh;
            background: linear-gradient(rgba(15, 23, 42, 0.8), rgba(15, 23, 42, 0.8)),
                url('https://images.unsplash.com/photo-1451187580459-43490279c0fa?auto=format&fit=crop&w=1500&q=80');
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-align: center;
        }
    </style>
@endpush

@section('content')

    <section class="hero-search">
        <div class="container text-center">
            <h1 style="font-weight: 800; font-size: 2.5rem; margin-bottom: 0.5rem;">خدماتنا</h1>
        </div>
    </section>

    <div class="container section-padding">
        <div class="main-layout">
            <main>
                @if ($services->count() > 0)
                    <div class="grid main-search-grid"
                        style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.5rem;">
                        @foreach ($services as $service)
                            <div class="search-card"
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
                                    <a href="{{ route('services.show', $service->slug) }}">
                                        <h3>{{ $service->name }}</h3>
                                    </a>

                                    <p class="text-muted small">
                                        {{ \Illuminate\Support\Str::limit($service->description, 80) }}
                                    </p>
                                    <a href="{{ route('services.show', $service->slug) }}" id="whatsappBook"
                                        class="btn btn-primary mt-3">
                                        عرض التفاصيل
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    {{-- الـ Pagination لو استخدمت SimplePaginate أو Manual --}}
                    <div class="pagination-wrapper mt-5">
                        {{ $services->links() }}
                    </div>
                @else
                    <div style="text-align: center; padding: 5rem 2rem;">
                        <i class="fas fa-search-minus" style="font-size: 4rem; color: #cbd5e1; margin-bottom: 1.5rem;"></i>
                        <h2 style="font-weight: 800;">لا توجد خدمات!</h2>
                        <a href="{{ url('/') }}" class="btn btn-primary mt-3" style="border-radius: 12px;">العودة
                            للرئيسية</a>
                    </div>
                @endif
            </main>
        </div>
    </div>
@endsection
