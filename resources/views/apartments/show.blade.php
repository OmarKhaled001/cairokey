@extends('layouts.master')

@section('name', $apartment->name . ' - كايرو كي')

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
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

        /* تصميم الميديا والسلايدر */
        .apartment-gallery {
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

        .video-container {
            width: 100%;
            height: 100%;
        }

        .video-container iframe {
            width: 100%;
            height: 100%;
            border: none;
        }

        /* تفاصيل الشقة */
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

        .apartment-title {
            font-size: 2.5rem;
            font-weight: 800;
            color: var(--secondary-color);
            margin-bottom: 1rem;
            letter-spacing: -0.025em;
        }

        /* المميزات Tags */
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

        /* بطاقة الحجز الجانبية */
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

        .summary-box {
            margin-top: 1.5rem;
            padding: 1.5rem;
            background: #f8fafc;
            border-radius: 16px;
            border: 1px dashed #cbd5e1;
        }

        .custom-nav {
            width: 45px;
            height: 45px;
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: 0.3s;
            color: var(--secondary-color);
        }

        .custom-nav:hover {
            background: var(--primary-color);
            color: #fff;
            border-color: var(--primary-color);
        }

        .apartment-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1) !important;
        }

        .relatedSwiper .swiper-slide {
            height: auto;
        }

        /* تنسيق التواريخ المحجوزة في Flatpickr */
        .flatpickr-day.disabled {
            color: #cbd5e1 !important;
            cursor: not-allowed !important;
            background: #f1f5f9 !important;
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

            .apartment-gallery {
                height: 400px;
            }

            .apartment-title {
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

        {{-- 1. السلايدر (يظهر فقط إذا وجد ميديا) --}}
        @php
            $videoId = null;
            if ($apartment->video_url) {
                preg_match(
                    '%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i',
                    $apartment->video_url,
                    $match,
                );
                $videoId = $match[1] ?? null;
            }
            $hasImages = $apartment->images && count($apartment->images) > 0;
        @endphp

        @if ($videoId || $hasImages || $apartment->cover)
            <div class="apartment-gallery shadow-xl">
                <div class="swiper mainSwiper">
                    <div class="swiper-wrapper">
                        {{-- فيديو يوتيوب --}}
                        @if ($videoId)
                            <div class="swiper-slide">
                                <div class="video-container">
                                    <iframe src="https://www.youtube.com/embed/{{ $videoId }}"
                                        allowfullscreen></iframe>
                                </div>
                            </div>
                        @endif

                        @if ($hasImages)
                            @foreach ($apartment->images as $image)
                                <div class="swiper-slide">
                                    <img src="{{ $image ? asset('storage/' . $image) : 'https://placehold.co/600x400?text=Apartment' }}"
                                        alt="{{ $apartment->name }}">
                                </div>
                            @endforeach
                        @else
                            <div class="swiper-slide">
                                <img src="{{ $apartment->cover ? asset('storage/' . $apartment->cover) : 'https://placehold.co/600x400?text=Apartment' }}"
                                    alt="{{ $apartment->name }}">
                            </div>
                        @endif
                    </div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        @endif

        {{-- 2. الشبكة الرئيسية --}}
        <div class="details-grid">

            {{-- المعلومات --}}
            <div class="info-card">
                <span class="badge"
                    style="background: var(--primary-color); color: white; padding: 5px 15px; border-radius: 50px; font-size: 0.8rem; font-weight: bold; margin-bottom: 1rem; display: inline-block;">إقامة
                    مميزة</span>
                <h1 class="apartment-title">{{ $apartment->name }}</h1>
                <p style="font-size: 1.1rem; color: #64748b; margin-bottom: 2rem;">
                    <i class="fas fa-map-marker-alt text-primary ml-1"></i> {{ $apartment->city }}
                </p>

                <div class="description-section">
                    <h3 style="font-weight: 700; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 10px;">
                        <span
                            style="width: 4px; height: 24px; background: var(--primary-color); border-radius: 10px; display: inline-block;"></span>
                        عن هذه الشقة
                    </h3>
                    <p style="line-height: 2; color: #475569; font-size: 1.1rem;">{{ $apartment->description }}</p>
                </div>

                <div class="amenities-section" style="margin-top: 3.5rem;">
                    <h3 style="font-weight: 700; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 10px;">
                        <span
                            style="width: 4px; height: 24px; background: var(--primary-color); border-radius: 10px; display: inline-block;"></span>
                        المرافق والخدمات
                    </h3>
                    <div class="tags-grid">
                        <div class="tag-item">
                            <i class="fas fa-bed"></i>
                            <span>{{ $apartment->rooms }} غرف نوم</span>
                        </div>
                        @if ($apartment->tags)
                            @foreach ($apartment->tags as $tag)
                                <div class="tag-item">
                                    <i class="fas fa-check-circle"></i>
                                    <span>{{ $tag }}</span>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>

            {{-- كرت الحجز المطور --}}
            <div class="booking-card border-0">
                {{-- صندوق السعر المحدث --}}
                <div class="price-box shadow-2xl"
                    style="background: #0f172a; color: white; padding: 2rem 1.5rem; border-radius: 24px; margin-bottom: 2rem; display: flex; align-items: center; justify-content: space-between;">
                    <div
                        style="writing-mode: vertical-rl; text-orientation: mixed; font-size: 1.1rem; font-weight: 700; color: #fff; border-right: 2px solid rgba(255,255,255,0.1); padding-right: 15px; margin-right: 15px;">
                        متوسط السعر
                    </div>

                    <div style="flex-grow: 1; text-align: center;">
                        <span style="font-size: 0.9rem; display: block; opacity: 0.8; margin-bottom: 5px;">يبدأ من</span>
                        <span
                            style="font-size: 2.8rem; font-weight: 800; line-height: 1;">{{ number_format($apartment->price_per_night, 2) }}</span>
                        <span style="font-size: 2rem; margin-top: 5px;">$</span>
                    </div>

                    <div style="display: flex; flex-direction: column; align-items: flex-end; gap: 5px; color: #64748b;">
                        <span style="font-size: 1rem; font-weight: 600;">لكل</span>
                        <span style="font-size: 1rem; font-weight: 600;">ليلة</span>
                    </div>
                </div>

                <div class="offer-summary"
                    style="margin-bottom: 2rem; color: #475569; text-align: center; font-weight: 500; line-height: 1.6;">
                    <p>استمتع بإقامة فاخرة في {{ $apartment->name }}.<br>السعر النهائي يتحدد حسب تواريخ الحجز والموسم.</p>
                </div>

                @php
                    // تجهيز رسالة الواتساب التلقائية
                    $waMessage = "مرحباً كايرو كي، أرغب في الاستفسار عن حجز:\n";
                    $waMessage .= '🏠 العقار: ' . $apartment->name . "\n";
                    $waMessage .= '💰 السعر المعلن: ' . $apartment->price_per_night . "$ لكل ليلة";
                    $waLink = 'https://wa.me/201068778340?text=' . urlencode($waMessage);
                @endphp

                {{-- زر الواتساب المباشر --}}
                <a href="{{ $waLink }}" target="_blank" class="whatsapp-btn"
                    style="background: #25D366; color: white; padding: 1.25rem; border-radius: 18px; display: flex; align-items: center; justify-content: center; gap: 12px; font-weight: 700; font-size: 1.2rem; text-decoration: none; transition: 0.3s; box-shadow: 0 10px 20px -5px rgba(37, 211, 102, 0.4);">
                    <i class="fab fa-whatsapp" style="font-size: 1.6rem;"></i>
                    احجز الآن عبر واتساب
                </a>

                <div
                    style="display: flex; align-items: center; justify-content: center; gap: 8px; margin-top: 1.5rem; color: #94a3b8; font-size: 0.85rem;">
                    <i class="fas fa-bolt"></i>
                    <span>رد فوري وتأكيد متاح 24/7</span>
                </div>
            </div>
        </div>
    </div>
    {{-- 
    <div class="related-apartments container" style="margin-top: 5rem; border-top: 1px solid #e2e8f0; padding-top: 4rem;">
        <div class="d-flex justify-between align-center" style="margin-bottom: 2rem;">
            <div>
                <h2 style="font-weight: 800; color: var(--secondary-color);">شقق قد تعجبك</h2>
                <p style="color: #64748b;">استكشف المزيد من خيارات الإقامة المميزة في كايرو كي</p>
            </div>
            <div class="swiper-nav-wrapper d-flex gap-2">
                <div class="swiper-button-prev-related custom-nav"><i class="fas fa-chevron-right"></i></div>
                <div class="swiper-button-next-related custom-nav"><i class="fas fa-chevron-left"></i></div>
            </div>
        </div>

        <div class="swiper relatedSwiper" style="padding: 10px 5px 40px;">
            <div class="swiper-wrapper">
                @foreach ($relatedApartments as $related)
                    <div class="swiper-slide">
                        <div class="apartment-card shadow-sm"
                            style="background: #fff; border-radius: 20px; overflow: hidden; border: 1px solid #eee; transition: 0.3s;">
                            <div style="height: 220px; overflow: hidden; position: relative;">
                                <img src="{{ asset('storage/' . $related->cover) }}"
                                    style="width: 100%; height: 100%; object-fit: cover;" alt="{{ $related->name }}">
                                <div
                                    style="position: absolute; top: 15px; left: 15px; background: rgba(255,255,255,0.9); padding: 5px 12px; border-radius: 10px; font-weight: 700; color: var(--primary-color);">
                                    ${{ $related->price_per_night }}
                                </div>
                            </div>
                            <div style="padding: 1.5rem;">
                                <h4 style="font-weight: 700; margin-bottom: 10px; color: var(--secondary-color);">
                                    {{ $related->name }}</h4>
                                <p style="color: #64748b; font-size: 0.9rem; margin-bottom: 1.5rem;">
                                    <i class="fas fa-map-marker-alt ml-1"></i> {{ $related->city }}
                                </p>
                                <a href="{{ route('apartments.show', $related->slug) }}" class="btn-outline"
                                    style="display: block; text-align: center; padding: 10px; border-radius: 12px; border: 1.5px solid var(--primary-color); color: var(--primary-color); font-weight: 700; transition: 0.3s;">
                                    عرض التفاصيل
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div> --}}
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://npmcdn.com/flatpickr/dist/l10n/ar.js"></script>
    <script>
        // Swiper Config
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
        });

        // Booking Logic
        const pricePerNight = {{ $apartment->price_per_night }};
        const bookings = @json($apartment->bookings->map(fn($b) => ['from' => $b->start_date, 'to' => $b->end_date]));

        // دالة للتحقق من التداخل مع الحجوزات
        function checkDateOverlap(start, end) {
            for (let booking of bookings) {
                const bookingStart = new Date(booking.from);
                const bookingEnd = new Date(booking.to);

                // التحقق من أي تداخل
                if (start <= bookingEnd && end >= bookingStart) {
                    return {
                        hasOverlap: true,
                        bookingStart: booking.from,
                        bookingEnd: booking.to
                    };
                }
            }
            return {
                hasOverlap: false
            };
        }

        // دالة لتعطيل التواريخ المحجوزة
        function disableBookedDates(date) {
            const dateStr = date.toISOString().split('T')[0];

            for (let booking of bookings) {
                const start = new Date(booking.from);
                const end = new Date(booking.to);

                // تعطيل جميع التواريخ داخل نطاق الحجز
                if (date >= start && date <= end) {
                    return true;
                }
            }
            return false;
        }

        // إعداد Flatpickr
        const fp = flatpickr("#checkIn", {
            "locale": "ar",
            mode: "range",
            minDate: "today",
            dateFormat: "Y-m-d",
            disable: [disableBookedDates], // تعطيل التواريخ المحجوزة
            onChange: function(dates, dateStr, instance) {
                const errorMsg = document.getElementById('errorMessage');
                const errorText = document.getElementById('errorText');
                const bookingSummary = document.getElementById('bookingSummary');
                const whatsappBtn = document.getElementById('whatsappBook');

                // إخفاء الرسالة والملخص عند البداية
                errorMsg.classList.remove('show');
                bookingSummary.style.display = 'none';
                whatsappBtn.classList.add('disabled');

                if (dates.length === 2) {
                    const startDate = dates[0];
                    const endDate = dates[1];

                    // التحقق من التداخل
                    const overlapCheck = checkDateOverlap(startDate, endDate);

                    if (overlapCheck.hasOverlap) {
                        // إظهار رسالة خطأ
                        errorText.textContent =
                            `عذراً، هناك حجز مؤكد من ${overlapCheck.bookingStart} إلى ${overlapCheck.bookingEnd}. الرجاء اختيار تواريخ أخرى.`;
                        errorMsg.classList.add('show');

                        // مسح التواريخ المحددة
                        instance.clear();
                        return;
                    }

                    // حساب عدد الليالي
                    const diffDays = Math.ceil(Math.abs(endDate - startDate) / (1000 * 60 * 60 * 24));
                    const totalPrice = diffDays * pricePerNight;

                    // إظهار الملخص
                    bookingSummary.style.display = 'block';
                    document.getElementById('nightCount').innerText = `${diffDays} ليلة`;
                    document.getElementById('totalAmount').innerText = `${totalPrice} $`;

                    // تفعيل زر الواتساب
                    whatsappBtn.classList.remove('disabled');

                    // إعداد رسالة الواتساب
                    const start = startDate.toLocaleDateString('ar-EG');
                    const end = endDate.toLocaleDateString('ar-EG');
                    const msg =
                        `مرحباً، أرغب بحجز: {{ $apartment->name }}\nالوصول: ${start}\nالمغادرة: ${end}\nالمدة: ${diffDays} ليالي\nالإجمالي: ${totalPrice} $`;
                    whatsappBtn.href = `https://wa.me/201068778340?text=${encodeURIComponent(msg)}`;
                }
            },
            onDayCreate: function(dObj, dStr, fp, dayElem) {
                // إضافة tooltip للأيام المحجوزة
                if (disableBookedDates(dayElem.dateObj)) {
                    dayElem.title = "هذا اليوم محجوز";
                }
            }
        });

        // Swiper للشقق المشابهة
        new Swiper(".relatedSwiper", {
            slidesPerView: 1,
            spaceBetween: 20,
            navigation: {
                nextEl: ".swiper-button-next-related",
                prevEl: ".swiper-button-prev-related",
            },
            breakpoints: {
                640: {
                    slidesPerView: 2
                },
                1024: {
                    slidesPerView: 3
                },
                1280: {
                    slidesPerView: 4
                },
            },
            loop: true,
        });
    </script>
@endpush
