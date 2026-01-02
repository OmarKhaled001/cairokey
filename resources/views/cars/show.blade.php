@extends('layouts.master')

@section('name', $car->brand . ' ' . $car->name . ' - كايرو كي')

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

        /* تصميم الغلاف والصور */
        .car-cover-container {
            position: relative;
            width: 100%;
            height: 500px;
            border-radius: var(--radius-lg);
            overflow: hidden;
            margin-bottom: 3rem;
        }

        .car-cover-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
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

        .apartment-title,
        .car-title {
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

            .apartment-gallery,
            .car-cover-container {
                height: 400px;
            }

            .apartment-title,
            .car-title {
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

        {{-- 1. صورة الغلاف فقط --}}
        <div class="car-cover-container shadow-xl">
            <img src="{{ $car->cover ? asset('storage/' . $car->cover) : 'https://placehold.co/1200x500?text=Car+Image' }}"
                alt="{{ $car->name }}">
            <div
                style="position: absolute; bottom: 0; left: 0; right: 0; height: 100px; background: linear-gradient(transparent, rgba(0,0,0,0.2));">
            </div>
        </div>

        {{-- 2. الشبكة الرئيسية --}}
        <div class="details-grid">

            {{-- معلومات السيارة --}}
            <div class="info-card">

                <h1 class="apartment-title"> {{ $car->name }}</h1>
                <span class="badge"
                    style="background: var(--primary-color); color: white; padding: 5px 15px; border-radius: 50px; font-size: 0.8rem; font-weight: bold; margin-bottom: 1rem; display: inline-block;">
                    {{ $car->brand }}
                </span>
                <span class="badge"
                    style="background: var(--primary-color); color: white; padding: 5px 15px; border-radius: 50px; font-size: 0.8rem; font-weight: bold; margin-bottom: 1rem; display: inline-block;">
                    {{ $car->model }}
                </span>
                <p style="font-size: 1.1rem; color: #64748b; margin-bottom: 2rem;">
                    <i class="fas fa-calendar-alt text-primary ml-1"></i> موديل سنة {{ $car->year }}
                </p>

                <div class="description-section">
                    <h3 style="font-weight: 700; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 10px;">
                        <span
                            style="width: 4px; height: 24px; background: var(--primary-color); border-radius: 10px; display: inline-block;"></span>
                        حول هذه السيارة
                    </h3>
                    <p style="line-height: 2; color: #475569; font-size: 1.1rem;">{{ $car->description }}</p>
                </div>

                <div class="amenities-section" style="margin-top: 3.5rem;">
                    <h3 style="font-weight: 700; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 10px;">
                        <span
                            style="width: 4px; height: 24px; background: var(--primary-color); border-radius: 10px; display: inline-block;"></span>
                        المواصفات الأساسية
                    </h3>
                    <div class="tags-grid">

                        @if ($car->tags)
                            @foreach ($car->tags as $tag)
                                <div class="tag-item">
                                    <i class="fas fa-check-circle"></i>
                                    <span>{{ $tag }}</span>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>

            <div class="booking-card">
                <div class="price-box shadow-lg">
                    <span class="unit">يبدأ من</span>
                    <span class="amount">${{ $car->price_per_day }}</span>
                    <span class="unit">لكل يوم</span>
                </div>

                @php
                    // سحب الرقم من الموديل
                    $whatsappNumber = \App\Models\Setting::get('whatsapp');

                    // تجهيز الرسالة
                    $waMsg = "مرحباً كايرو كي، أرغب في الاستفسار عن حجز:\n";
                    $waMsg .= '🚗 ' . $car->name . "\n";

                    // تنظيف الرقم من أي مسافات أو علامات زائد لضمان عمل الرابط
                    $cleanNumber = preg_replace('/[^0-9]/', '', $whatsappNumber);
                    $waUrl = 'https://wa.me/' . $cleanNumber . '?text=' . urlencode($waMsg);
                @endphp

                <a href="{{ $waUrl }}" target="_blank" class="whatsapp-btn"
                    style="background: #25D366; color: white; padding: 1.2rem; border-radius: 20px; display: flex; align-items: center; justify-content: center; gap: 12px; font-weight: 700; font-size: 1.15rem; text-decoration: none; transition: 0.4s ease; box-shadow: 0 12px 24px -8px rgba(37, 211, 102, 0.5);">
                    <i class="fab fa-whatsapp" style="font-size: 1.7rem;"></i>
                    تواصل للحجز الفوري
                </a>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/ar.js"></script>
    <script>
        // Booking Logic
        const pricePerDay = {{ $car->price_per_day }};
        const bookings = @json($car->bookings->map(fn($b) => ['from' => $b->start_date, 'to' => $b->end_date]));

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

                    // حساب عدد الأيام
                    const diffDays = Math.ceil(Math.abs(endDate - startDate) / (1000 * 60 * 60 * 24));
                    const totalPrice = diffDays * pricePerDay;

                    // إظهار الملخص
                    bookingSummary.style.display = 'block';
                    document.getElementById('nightCount').innerText = `${diffDays} يوم`;
                    document.getElementById('totalAmount').innerText = `${totalPrice} $`;

                    // تفعيل زر الواتساب
                    whatsappBtn.classList.remove('disabled');

                    // إعداد رسالة الواتساب
                    const start = startDate.toLocaleDateString('ar-EG');
                    const end = endDate.toLocaleDateString('ar-EG');
                    const msg =
                        `مرحباً، أرغب بحجز: {{ $car->name }}\nالوصول: ${start}\nالمغادرة: ${end}\nالمدة: ${diffDays} يوم\nالإجمالي: ${totalPrice} $`;
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
    </script>
@endpush
