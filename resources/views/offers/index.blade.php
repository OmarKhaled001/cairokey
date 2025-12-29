@extends('layouts.master')

@section('name', 'العروض المتاحة - كايرو كي')

@push('styles')
    <style>
        :root {
            --card-shadow-hover: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        .hero-offers {
            height: 30vh;
            background: linear-gradient(rgba(15, 23, 42, 0.8), rgba(15, 23, 42, 0.8)),
                url('https://images.unsplash.com/photo-1549144511-60991c094bc2?auto=format&fit=crop&w=1500&q=80');
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-align: center;
        }

        .offer-card {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            transition: all 0.3s ease;
            border: 1px solid #f1f5f9;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .offer-card:hover {
            transform: translateY(-10px);
            box-shadow: var(--card-shadow-hover);
        }

        .offer-image {
            height: 220px;
            position: relative;
            overflow: hidden;
        }

        .offer-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .offer-card:hover .offer-image img {
            transform: scale(1.1);
        }

        .price-tag {
            position: absolute;
            bottom: 15px;
            right: 15px;
            background: var(--primary-color);
            color: white;
            padding: 5px 15px;
            border-radius: 50px;
            font-weight: 800;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .old-price-tag {
            position: absolute;
            bottom: 15px;
            left: 15px;
            background: rgba(0, 0, 0, 0.6);
            color: #fff;
            padding: 5px 10px;
            border-radius: 5px;
            text-decoration: line-through;
            font-size: 0.8rem;
        }

        @media (max-width: 768px) {
            .hero-offers {
                height: 25vh;
            }
        }
    </style>
@endpush

@section('content')

    <section class="hero-offers">
        <div class="container text-center">
            <h1 style="font-weight: 800; font-size: 2.5rem; margin-bottom: 0.5rem;">العروض الحصرية</h1>
            <p style="opacity: 0.9;">أفضل الباقات والعروض السياحية صممت خصيصاً لك</p>
        </div>
    </section>

    <div class="container section-padding" style="margin-top: 50px; margin-bottom: 50px;">
        @if ($offers->count() > 0)
            <div class="row">
                @foreach ($offers as $offer)
                    <div class="col-md-4 mb-4">
                        <div class="offer-card">
                            <div class="offer-image">
                                <img src="{{ $offer->cover ? asset('storage/' . $offer->cover) : 'https://placehold.co/600x400?text=Offer' }}"
                                    alt="{{ $offer->name }}">
                                <span class="price-tag">{{ $offer->price }} $</span>
                                @if ($offer->original_price && $offer->original_price > $offer->price)
                                    <span class="old-price-tag">{{ $offer->original_price }} $</span>
                                @endif
                            </div>
                            <div class="p-4 flex-grow-1 d-flex flex-column">
                                <h3 class="fw-bold mb-2">{{ $offer->name }}</h3>
                                <p class="text-muted small mb-3">{{ Str::limit($offer->description, 80) }}</p>

                                <div class="mt-auto d-flex justify-content-between align-items-center">
                                    <a href="{{ route('offers.show', $offer->slug) }}"
                                        class="btn btn-outline-primary w-100 rounded-pill">التفاصيل</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="d-flex justify-content-center mt-4">
                {{ $offers->links() }}
            </div>
        @else
            <div class="text-center py-5">
                <i class="fas fa-gift fa-4x text-muted mb-3"></i>
                <h3 class="text-muted">لا توجد عروض متاحة حالياً</h3>
            </div>
        @endif
    </div>

@endsection
