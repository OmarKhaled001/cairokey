@extends('layouts.master')

@section('name', $offer->name . ' - كايرو كي')

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <style>
        :root {
            --accent-bg: #f8fafc;
            --glass-bg: rgba(255, 255, 255, 0.95);
        }

        body {
            background-color: var(--accent-bg);
        }

        .show-container {
            padding-top: 5rem;
            padding-bottom: 5rem;
        }

        /* Cover Image */
        .offer-cover-container {
            position: relative;
            width: 100%;
            height: 500px;
            border-radius: var(--radius-lg);
            overflow: hidden;
            margin-bottom: 3rem;
        }

        .offer-cover-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .details-grid {
            display: grid;
            grid-template-columns: 1.7fr 1fr;
            gap: 3rem;
            align-items: start;
        }

        .info-card {
            background: #ffffff;
            padding: 3rem;
            border-radius: 24px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        }

        .offer-title {
            font-size: 2.5rem;
            font-weight: 800;
            color: var(--secondary-color);
            margin-bottom: 1rem;
            letter-spacing: -0.025em;
        }

        .tags-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
            gap: 1.25rem;
            margin-top: 2rem;
        }

        .tag-item {
            background: var(--accent-bg);
            padding: 1rem;
            border-radius: 16px;
            display: flex;
            align-items: center;
            gap: 12px;
            border: 1px solid rgba(0, 0, 0, 0.03);
            transition: all 0.3s ease;
        }

        .tag-item:hover {
            transform: translateY(-3px);
            background: #fff;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }

        .tag-item i {
            color: var(--primary-color);
            font-size: 1.2rem;
        }

        .booking-card {
            background: #ffffff;
            padding: 2.5rem;
            border-radius: 24px;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 110px;
            border: 1px solid var(--border-color);
        }

        .price-box {
            background: var(--secondary-color);
            color: white;
            padding: 1.5rem;
            border-radius: 20px;
            margin-bottom: 2rem;
            text-align: center;
        }

        .price-box .amount {
            font-size: 2.2rem;
            font-weight: 800;
            display: block;
        }

        .price-box .old-price {
            text-decoration: line-through;
            opacity: 0.7;
            font-size: 1.2rem;
            display: block;
            margin-bottom: 5px;
        }

        .whatsapp-btn {
            background: #25D366;
            color: white;
            padding: 1.25rem;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            font-weight: 700;
            font-size: 1.1rem;
            margin-top: 1.5rem;
            transition: 0.3s;
            text-decoration: none;
        }

        .whatsapp-btn:hover {
            background: #1da851;
            transform: scale(1.02);
            color: #fff;
        }

        .offer-items-list {
            list-style: none;
            padding: 0;
            margin-top: 2rem;
        }

        .offer-items-list li {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            margin-bottom: 1rem;
            font-size: 1.1rem;
            color: #475569;
        }

        .offer-items-list li i {
            color: var(--primary-color);
            margin-top: 5px;
        }

        @media (max-width: 992px) {
            .details-grid {
                grid-template-columns: 1fr;
            }

            .offer-cover-container {
                height: 400px;
            }

            .offer-title {
                font-size: 1.8rem;
            }

            .booking-card {
                position: relative;
                top: 0;
            }
        }
    </style>
@endpush

@section('content')
    <div class="show-container container">
        {{-- Cover Image --}}
        <div class="offer-cover-container shadow-xl">
            <img src="{{ $offer->cover ? asset('storage/' . $offer->cover) : 'https://placehold.co/1200x500?text=Offer+Image' }}"
                alt="{{ $offer->name }}">
            <div
                style="position: absolute; bottom: 0; left: 0; right: 0; height: 100px; background: linear-gradient(transparent, rgba(0,0,0,0.2));">
            </div>
        </div>

        <div class="details-grid">
            {{-- Info Card --}}
            <div class="info-card">
                <h1 class="offer-title">{{ $offer->name }}</h1>

                @if ($offer->start_date && $offer->end_date)
                    <p style="font-size: 1.1rem; color: #64748b; margin-bottom: 2rem;">
                        <i class="fas fa-calendar-alt text-primary ml-1"></i>
                        متاح من {{ \Carbon\Carbon::parse($offer->start_date)->translatedFormat('d F Y') }}
                        إلى {{ \Carbon\Carbon::parse($offer->end_date)->translatedFormat('d F Y') }}
                    </p>
                @endif

                <div class="description-section">
                    <h3 style="font-weight: 700; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 10px;">
                        <span
                            style="width: 4px; height: 24px; background: var(--primary-color); border-radius: 10px; display: inline-block;"></span>
                        تفاصيل العرض
                    </h3>
                    <p style="line-height: 2; color: #475569; font-size: 1.1rem;">{{ $offer->description }}</p>
                </div>

                @if ($offer->offer_items && $offer->offer_items->count() > 0)
                    <div class="amenities-section" style="margin-top: 3.5rem;">
                        <h3 style="font-weight: 700; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 10px;">
                            <span
                                style="width: 4px; height: 24px; background: var(--primary-color); border-radius: 10px; display: inline-block;"></span>
                            ما يشمله العرض
                        </h3>
                        <ul class="offer-items-list">
                            @foreach ($offer->offer_items as $item)
                                <li>
                                    <i class="fas fa-check-circle"></i>
                                    <span>{{ $item }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if ($offer->tags && is_array($offer->tags) && count($offer->tags) > 0)
                    <div class="amenities-section" style="margin-top: 3.5rem;">
                        <h3 style="font-weight: 700; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 10px;">
                            <span
                                style="width: 4px; height: 24px; background: var(--primary-color); border-radius: 10px; display: inline-block;"></span>
                            المميزات
                        </h3>
                        <div class="tags-grid">
                            @foreach ($offer->tags as $tag)
                                <div class="tag-item">
                                    <i class="fas fa-star"></i>
                                    <span>{{ $tag }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            {{-- Booking Side Card --}}
            <div class="booking-card">
                <div class="price-box shadow-lg">
                    @if ($offer->original_price && $offer->original_price > $offer->price)
                        <span class="old-price">{{ number_format($offer->original_price, 0) }} $</span>
                    @endif
                    <span class="amount">{{ number_format($offer->price, 0) }} $</span>
                    <span class="unit">سعر العرض</span>
                </div>

                <div class="offer-summary" style="margin-bottom: 1.5rem; color: #64748b; text-align: center;">
                    <p>احجز هذا العرض المميز الآن واستمتع بتجربة لا تنسى.</p>
                </div>

                @php
                    $message = 'مرحباً، أرغب بحجز العرض: ' . $offer->name . "\nالسعر: " . $offer->price . "$";
                    $whatsappLink = 'https://wa.me/201068778340?text=' . urlencode($message);
                @endphp

                <a href="{{ $whatsappLink }}" target="_blank" class="whatsapp-btn">
                    <i class="fab fa-whatsapp"></i>
                    احجز الآن عبر واتساب
                </a>
                <p style="text-align: center; color: #94a3b8; font-size: 0.85rem; margin-top: 1.25rem;">
                    <i class="fas fa-info-circle ml-1"></i> تواصل معنا لمعرفة المزيد من التفاصيل
                </p>
            </div>
        </div>



    </div>
@endsection
