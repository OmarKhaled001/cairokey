@extends('layouts.master')

@section('name', 'السيارات المتاحة - كايرو كي')

@push('styles')
    <style>
        :root {
            --filter-bg: #ffffff;
            --card-shadow-hover: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        * {
            font-family: "Cairo";
        }

        .hero-cars {
            height: 30vh;
            background: linear-gradient(rgba(15, 23, 42, 0.8), rgba(15, 23, 42, 0.8)),
                url('https://images.unsplash.com/photo-1492144534655-ae79c964c9d7?auto=format&fit=crop&w=1500&q=80');
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-align: center;
        }

        /* تصميم الفلاتر - Desktop */
        .filter-sidebar {
            background: var(--filter-bg);
            padding: 2rem;
            border-radius: 20px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
            border: 1px solid #e2e8f0;
            position: sticky;
            top: 100px;
        }

        .filter-group {
            margin-bottom: 1.5rem;
        }

        .filter-group label {
            display: block;
            font-weight: 700;
            margin-bottom: 0.5rem;
            color: var(--secondary-color);
            font-size: 0.9rem;
        }

        .form-control-custom {
            width: 100%;
            padding: 0.6rem 1rem;
            border-radius: 10px;
            border: 1px solid #cbd5e1;
            font-size: 0.9rem;
        }

        /* زر الفلتر للموبايل */
        .mobile-filter-toggle {
            display: none;
            position: fixed;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 999;
            background: var(--primary-color);
            color: white;
            padding: 15px 30px;
            border-radius: 50px;
            border: none;
            font-weight: 700;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .mobile-filter-toggle:active {
            transform: translateX(-50%) scale(0.95);
        }

        /* Overlay للموبايل */
        .filter-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 998;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .filter-overlay.active {
            opacity: 1;
        }

        /* تصميم كروت السيارات */
        .apt-card {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            transition: all 0.3s ease;
            border: 1px solid #f1f5f9;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .apt-card:hover {
            transform: translateY(-10px);
            box-shadow: var(--card-shadow-hover);
        }

        .apt-image {
            height: 220px;
            position: relative;
            overflow: hidden;
        }

        .apt-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .apt-card:hover .apt-image img {
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

        /* Pagination */
        .pagination-wrapper nav {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            margin-top: 2rem;
        }

        .pagination-wrapper .flex.items-center.justify-between div:first-child {
            display: none;
        }

        .pagination-wrapper ul.pagination,
        .pagination-wrapper nav div:last-child {
            display: flex !important;
            list-style: none;
            padding: 0;
            gap: 5px;
        }

        .pagination-wrapper a,
        .pagination-wrapper span {
            display: flex;
            align-items: center;
            justify-content: center;
            min-width: 40px;
            height: 40px;
            padding: 0 15px;
            border-radius: 10px;
            border: 1px solid #e2e8f0;
            background: white;
            color: var(--secondary-color);
            text-decoration: none;
            font-weight: 600;
            transition: 0.3s;
        }

        .pagination-wrapper .active span,
        .pagination-wrapper span[aria-current="page"] {
            background: var(--primary-color) !important;
            color: white !important;
            border-color: var(--primary-color) !important;
        }

        .pagination-wrapper a:hover {
            background: #f8fafc;
            border-color: var(--primary-color);
            color: var(--primary-color);
        }

        .pagination-wrapper svg {
            width: 20px;
            height: 20px;
        }

        /* Range Slider */
        .modern-range {
            -webkit-appearance: none;
            width: 100%;
            height: 6px;
            background: #e2e8f0;
            border-radius: 5px;
            outline: none;
        }

        .modern-range::-webkit-slider-thumb {
            -webkit-appearance: none;
            width: 22px;
            height: 22px;
            background: var(--primary-color);
            border: 4px solid white;
            border-radius: 50%;
            cursor: pointer;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: 0.2s;
        }

        .modern-range::-webkit-slider-thumb:hover {
            transform: scale(1.2);
            box-shadow: 0 0 0 8px rgba(var(--primary-rgb), 0.1);
        }

        /* Empty State Styles */
        .empty-state {
            animation: fadeInUp 0.6s ease-out;
        }

        .empty-state i.fa-search {
            animation: bounce 2s infinite;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes bounce {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        /* تحسينات الموبايل */
        @media (max-width: 768px) {
            .hero-cars {
                height: 25vh;
            }

            .hero-cars h1 {
                font-size: 1.8rem !important;
            }

            .main-layout {
                grid-template-columns: 1fr !important;
                gap: 1rem !important;
            }

            /* إخفاء الفلتر على الموبايل وجعله منبثق */
            aside {
                position: fixed;
                top: 0;
                right: -100%;
                width: 85%;
                max-width: 350px;
                height: 100vh;
                overflow-y: auto;
                z-index: 999;
                transition: right 0.3s ease;
                background: white;
            }

            aside.active {
                right: 0;
            }

            .filter-sidebar {
                position: relative;
                top: 0;
                border-radius: 0;
                height: 100%;
                box-shadow: none;
                border: none;
                border-left: 1px solid #e2e8f0;
            }

            /* إظهار زر الفلتر */
            .mobile-filter-toggle {
                display: flex;
                align-items: center;
                gap: 8px;
            }

            .filter-overlay {
                display: block;
            }

            /* Header للفلتر على الموبايل */
            .filter-mobile-header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 1.5rem;
                padding-bottom: 1rem;
                border-bottom: 2px solid #f1f5f9;
            }

            .filter-mobile-header h4 {
                margin: 0;
                font-weight: 800;
            }

            .close-filter-btn {
                background: #f1f5f9;
                border: none;
                width: 35px;
                height: 35px;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                cursor: pointer;
                transition: 0.2s;
            }

            .close-filter-btn:active {
                transform: scale(0.9);
                background: #e2e8f0;
            }

            /* Grid السيارات */
            .grid-cols-3 {
                grid-template-columns: 1fr !important;
            }

            /* تصغير حجم الكروت */
            .apt-image {
                height: 180px;
            }

            /* تحسين الـ Pagination */
            .pagination-wrapper a,
            .pagination-wrapper span {
                min-width: 35px;
                height: 35px;
                padding: 0 10px;
                font-size: 0.85rem;
            }
        }

        /* للأجهزة الصغيرة جداً */
        @media (max-width: 480px) {
            .container {
                padding-left: 1rem;
                padding-right: 1rem;
            }

            aside {
                width: 90%;
            }

            .filter-sidebar {
                padding: 1.5rem;
            }

            .mobile-filter-toggle {
                padding: 12px 25px;
                font-size: 0.9rem;
            }
        }
    </style>
@endpush

@section('content')

    <section class="hero-cars">
        <div class="container text-center">
            <h1 style="font-weight: 800; font-size: 2.5rem; margin-bottom: 0.5rem;">أسطول سياراتنا الفاخرة</h1>
            <p style="opacity: 0.9;">اختر سيارتك المثالية لرحلتك القادمة</p>
        </div>
    </section>

    <!-- Overlay للموبايل -->
    <div class="filter-overlay" id="filterOverlay" onclick="closeFilter()"></div>

    <!-- زر الفلتر للموبايل -->
    <button class="mobile-filter-toggle" onclick="openFilter()">
        <i class="fas fa-filter"></i>
        <span>الفلاتر</span>
    </button>

    <div class="container section-padding">
        <div class="grid main-layout" style="grid-template-columns: 300px 1fr; gap: 2.5rem; display: grid;">

            <aside id="filterSidebar">
                <form action="{{ route('cars.index') }}" method="GET" class="filter-sidebar">

                    <!-- Header للموبايل فقط -->
                    <div class="filter-mobile-header" style="display: none;">
                        <h4>
                            <i class="fas fa-filter text-primary"></i>
                            تصفية النتائج
                        </h4>
                        <button type="button" class="close-filter-btn" onclick="closeFilter()">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>

                    <!-- Header للديسكتوب -->
                    <h4 class="desktop-filter-header"
                        style="font-weight: 800; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 10px;">
                        <i class="fas fa-filter text-primary"></i> تصفية النتائج
                    </h4>

                    <div class="filter-group">
                        <label>السنة</label>
                        <select name="year" class="form-control-custom">
                            <option value="">كل السنوات</option>
                            @foreach ($years as $year)
                                <option value="{{ $year }}" {{ request('year') == $year ? 'selected' : '' }}>
                                    {{ $year }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="filter-group">
                        <label>العلامة التجارية</label>
                        <select name="brand" class="form-control-custom">
                            <option value="">كل العلامات التجارية</option>
                            @foreach ($brands as $brand)
                                <option value="{{ $brand }}" {{ request('brand') == $brand ? 'selected' : '' }}>
                                    {{ $brand }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="filter-group">
                        <label>الموديل</label>
                        <select name="model" class="form-control-custom">
                            <option value="">كل الموديلات</option>
                            @foreach ($models as $model)
                                <option value="{{ $model }}" {{ request('model') == $model ? 'selected' : '' }}>
                                    {{ $model }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="filter-group">
                        <label>نطاق السعر (باليوم)</label>
                        <div class="price-range-container" style="padding: 10px 5px 30px;">
                            <input type="range" id="priceRange" min="{{ $minAvailablePrice }}"
                                max="{{ $maxAvailablePrice }}" value="{{ request('price_max', $maxAvailablePrice) }}"
                                class="modern-range" oninput="updatePriceLabel(this.value)">

                            <div
                                style="display: flex; justify-content: space-between; margin-top: 15px; font-size: 0.85rem; font-weight: 700;">
                                <span>${{ $minAvailablePrice }}</span>
                                <span class="text-primary">حتى: $<span
                                        id="currentPriceLabel">{{ request('price_max', $maxAvailablePrice) }}</span></span>
                            </div>

                            <input type="hidden" name="price_min" value="{{ $minAvailablePrice }}">
                            <input type="hidden" name="price_max" id="price_max_hidden"
                                value="{{ request('price_max', $maxAvailablePrice) }}">
                        </div>
                    </div>

                    <div class="filter-group">
                        <label>ترتيب حسب</label>
                        <select name="sort" class="form-control-custom">
                            <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>الأحدث أولاً
                            </option>
                            <option value="lowest_price" {{ request('sort') == 'lowest_price' ? 'selected' : '' }}>السعر:
                                من الأقل</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary "
                        style="padding: 0.8rem; border-radius: 12px; font-weight: 700;">
                        تطبيق الفلتر
                    </button>

                    @if (request()->anyFilled(['governorate', 'city', 'price_min', 'price_max', 'sort']))
                        <a href="{{ route('cars.index') }}"
                            style="display: block; text-align: center; margin-top: 1rem; color: #64748b; font-size: 0.8rem;">
                            إعادة ضبط
                        </a>
                    @endif
                </form>
            </aside>

            <main>
                @if ($cars->count() > 0)
                    <div class="grid grid-cols-3 gap-4">
                        @foreach ($cars as $car)
                            <div
                                style="background: var(--bg-light); border-radius: var(--radius-lg); overflow: hidden; box-shadow: var(--card-shadow);">
                                <div
                                    style="height: 250px; background-color: #ddd; background-image: url({{ $car->cover ? asset('storage/' . $car->cover) : 'https://placehold.co/600x400?text=Image' }}); background-size: cover;">
                                </div>
                                <div style="padding: 1.5rem;">
                                    <h3>{{ $car->name }}</h3>
                                    <p style="color: var(--text-light); font-size: 0.9rem; margin-bottom: 0.5rem;">
                                        {{ $car->model }} - {{ $car->year }}
                                    </p>
                                    <div class="d-flex justify-between align-center" style="margin-top: 1rem;">
                                        <span style="color: var(--primary-color); font-weight: bold; font-size: 1.1rem;">
                                            ${{ $car->price_per_day }} / يوم
                                        </span>
                                        <a href="{{ route('cars.show', $car) }}" class="btn btn-primary"
                                            style="padding: 0.5rem 1rem;">التفاصيل</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="pagination-wrapper">
                        {{ $cars->links() }}
                    </div>
                @else
                    {{-- Modern Empty State --}}
                    <div class="empty-state"
                        style="text-align: center; padding: 4rem 2rem; background: white; border-radius: 20px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);">
                        <div style="margin-bottom: 2rem;">
                            <i class="fas fa-search" style="font-size: 5rem; color: #cbd5e1; opacity: 0.5;"></i>
                        </div>

                        <h3
                            style="font-size: 1.8rem; font-weight: 700; color: var(--secondary-color); margin-bottom: 1rem;">
                            لم نجد أي سيارات
                        </h3>

                        <p
                            style="font-size: 1.1rem; color: #64748b; margin-bottom: 2rem; max-width: 500px; margin-left: auto; margin-right: auto;">
                            لا توجد سيارات تطابق معايير البحث. جرب تعديل الفلاتر أو البحث مرة أخرى.
                        </p>

                        <a href="{{ route('cars.index') }}" class="btn btn-primary"
                            style="padding: 0.875rem 2rem; border-radius: 12px; font-weight: 700; display: inline-flex; align-items: center; gap: 8px; text-decoration: none;">
                            <i class="fas fa-redo"></i>
                            <span>إعادة تعيين الفلاتر</span>
                        </a>
                    </div>
                @endif
            </main>
        </div>
    </div>

    <script>
        function updatePriceLabel(val) {
            document.getElementById('currentPriceLabel').innerText = val;
            document.getElementById('price_max_hidden').value = val;
        }

        function openFilter() {
            document.getElementById('filterSidebar').classList.add('active');
            document.getElementById('filterOverlay').classList.add('active');
            document.body.style.overflow = 'hidden'; // منع السكرول

            // إظهار header الموبايل وإخفاء header الديسكتوب
            if (window.innerWidth <= 768) {
                document.querySelector('.filter-mobile-header').style.display = 'flex';
                document.querySelector('.desktop-filter-header').style.display = 'none';
            }
        }

        function closeFilter() {
            document.getElementById('filterSidebar').classList.remove('active');
            document.getElementById('filterOverlay').classList.remove('active');
            document.body.style.overflow = ''; // إعادة السكرول
        }

        // إغلاق الفلتر عند تغيير حجم الشاشة للديسكتوب
        window.addEventListener('resize', function() {
            if (window.innerWidth > 768) {
                closeFilter();
                document.querySelector('.filter-mobile-header').style.display = 'none';
                document.querySelector('.desktop-filter-header').style.display = 'flex';
            }
        });

        // تطبيق الإعدادات الصحيحة عند تحميل الصفحة
        document.addEventListener('DOMContentLoaded', function() {
            if (window.innerWidth <= 768) {
                document.querySelector('.filter-mobile-header').style.display = 'none';
            }
        });
    </script>
@endsection
