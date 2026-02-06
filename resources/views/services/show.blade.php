@extends('layouts.master')

@section('name', $service->name . ' - كايرو كي')

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <!-- Add Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">

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

        /* تصميم الميديا والسلايدر */
        .service-gallery {
            background: #000;
            border-radius: var(--radius-lg);
            overflow: hidden;
            height: 500px;
            margin-bottom: 2rem;
        }

        .swiper {
            width: 100%;
            height: 100%;
        }

        .swiper-slide img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* Cover Image */
        .service-cover-container {
            position: relative;
            width: 100%;
            height: 500px;
            border-radius: var(--radius-lg);
            overflow: hidden;
            margin-bottom: 3rem;
        }

        .service-cover-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* Details Grid */
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

        .service-title {
            font-size: 2.5rem;
            font-weight: 800;
            color: var(--secondary-color);
            margin-bottom: 0.5rem;
            letter-spacing: -0.025em;
        }

        /* Tags */
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

        /* Booking Side Card */
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

        .price-box .unit {
            opacity: 0.8;
            font-size: 0.9rem;
        }

        .flatpickr-input {
            width: 85% !important;
            height: 55px;
            padding: 0 1.5rem !important;
            border-radius: 12px !important;
            border: 2px solid #edf2f7 !important;
            font-weight: 600 !important;
            background: #fdfdfd !important;
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

        .whatsapp-btn.disabled {
            background: #94a3b8;
            cursor: not-allowed;
            pointer-events: none;
        }

        .error-message {
            background: #fee;
            color: #c33;
            padding: 1rem;
            border-radius: 12px;
            margin-top: 1rem;
            display: none;
            border: 1px solid #fcc;
            font-size: 0.9rem;
        }

        .error-message.show {
            display: block;
            animation: shake 0.5s;
        }

        @keyframes shake {

            0%,
            100% {
                transform: translateX(0);
            }

            25% {
                transform: translateX(-10px);
            }

            75% {
                transform: translateX(10px);
            }
        }

        @media (max-width: 992px) {
            .details-grid {
                grid-template-columns: 1fr;
            }

            .service-cover-container {
                height: 400px;
            }

            .service-title {
                font-size: 1.8rem;
            }

            .service-gallery {
                height: 400px;
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

        {{-- 1. السلايدر (يظهر فقط إذا وجد ميديا) --}}
        @php
            $hasImages = $service->images && count($service->images) > 0;
            $hasCover = !empty($service->cover);
        @endphp

        @if ($hasImages || $hasCover)
            <div class="service-gallery shadow-xl">
                <div class="swiper mainSwiper">
                    <div class="swiper-wrapper">
                        {{-- Show cover first if available --}}
                        @if ($hasCover)
                            <div class="swiper-slide">
                                <img src="{{ asset('storage/' . $service->cover) }}" alt="{{ $service->name }}">
                            </div>
                        @endif

                        {{-- Then show additional images --}}
                        @if ($hasImages)
                            @foreach ($service->images as $image)
                                <div class="swiper-slide">
                                    <img src="{{ asset('storage/' . $image) }}" alt="{{ $service->name }}">
                                </div>
                            @endforeach
                        @endif

                        {{-- Fallback if neither cover nor images exist --}}
                        @if (!$hasCover && !$hasImages)
                            <div class="swiper-slide">
                                <img src="https://placehold.co/1200x500?text=Service+Image" alt="{{ $service->name }}">
                            </div>
                        @endif
                    </div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        @endif

        <div class="details-grid">
            {{-- Service Info --}}
            <div class="info-card">
                <h1 class="service-title">{{ $service->name }}</h1>

                <div class="description-section">
                    <h3 style="font-weight: 700; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 10px;">
                        <span
                            style="width: 4px; height: 24px; background: var(--primary-color); border-radius: 10px; display: inline-block;"></span>
                        تفاصيل الخدمة
                    </h3>
                    <p style="line-height: 2; color: #475569; font-size: 1.1rem;">{{ $service->description }}</p>
                </div>

                @if ($service->tags && is_array($service->tags) && count($service->tags) > 0)
                    <div class="amenities-section" style="margin-top: 3.5rem;">
                        <h3 style="font-weight: 700; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 10px;">
                            <span
                                style="width: 4px; height: 24px; background: var(--primary-color); border-radius: 10px; display: inline-block;"></span>
                            مميزات الخدمة
                        </h3>
                        <div class="tags-grid">
                            @foreach ($service->tags as $tag)
                                <div class="tag-item">
                                    <i class="fas fa-check-circle"></i>
                                    <span>{{ $tag }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            {{-- Booking Card --}}
            <div class="booking-card" style="text-align: center;">

                @php
                    use App\Models\Setting;
                    $whatsapp = Setting::get('whatsapp');

                    $message = 'مرحباً، أرغب بالاستفسار عن خدمة: ' . $service->name;
                    $whatsappLink = 'https://wa.me/' . $whatsapp . '?text=' . urlencode($message);
                @endphp

                <h3 style="font-weight: 800; margin-bottom: 1.5rem; color: var(--secondary-color);">مهتم بهذه الخدمة؟</h3>
                <p style="color: #64748b; margin-bottom: 2rem;">
                    تواصل معنا الآن عبر واتساب لمعرفة التفاصيل والأسعار وحجز الخدمة.
                </p>

                <a href="{{ $whatsappLink }}" target="_blank" class="whatsapp-btn">
                    <i class="fab fa-whatsapp"></i>
                    تواصل معنا الآن
                </a>
                <p style="text-align: center; color: #94a3b8; font-size: 0.85rem; margin-top: 1.25rem;">
                    <i class="fas fa-info-circle ml-1"></i> يتم الرد على الاستفسارات فوراً
                </p>
            </div>
        </div>

    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/ar.js"></script>

    <script>
        // Swiper  Config
        new Swiper(".mainSwiper", {
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev"
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
                dynamicBullets: true
            },
            loop: true,
            autoplay: {
                delay: 3000,
                disableOnInteraction: false,
            },
            speed: 600,
        });
    </script>
@endpush
