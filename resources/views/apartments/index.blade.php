@extends('layouts.master')

@section('name', 'الشقق المتاحة - كايرو كي')

@push('styles')
    <style>
        :root {
            --filter-bg: #ffffff;
            --card-shadow-hover: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        .hero-apartments {
            height: 35vh;
            background: linear-gradient(rgba(15, 23, 42, 0.7), rgba(15, 23, 42, 0.7)), url('https://images.unsplash.com/photo-1512917774080-9991f1c4c750?auto=format&fit=crop&w=1200&q=80');
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            margin-bottom: 3rem;
        }

        /* تصميم الفلاتر */
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

        /* تصميم كروت الشقق */
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

        .pagination-wrapper nav {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        /* إخفاء معلومات النص (Showing 1 to 10...) إذا كنت لا تريدها */
        .pagination-wrapper .flex.items-center.justify-between div:first-child {
            display: none;
        }

        /* تنسيق الأزرار والروابط */
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

        /* حالة الصفحة النشطة */
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

        /* إصلاح تداخل الأسهم */
        .pagination-wrapper svg {
            width: 20px;
            height: 20px;
        }

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

        /* تعديل الـ Grid للموبايل */
        @media (max-width: 768px) {
            .main-layout {
                grid-template-columns: 1fr !important;
            }

            .hero-apartments {
                height: 25vh;
            }
        }

        * {
            font-family: "Cairo";
        }
    </style>
@endpush

@section('content')

    <section class="hero-apartments">
        <div class="container text-center">
            <h1 style="font-weight: 800; font-size: 3rem;">اكتشف ملاذك القادم</h1>
            <p style="opacity: 0.9;">أفضل الشقق المختارة بعناية لتناسب ذوقك</p>
        </div>
    </section>

    <div class="container section-padding">
        <div class="grid main-layout" style="grid-template-columns: 300px 1fr; gap: 2.5rem; display: grid;">

            <aside>
                <form action="{{ route('apartments.index') }}" method="GET" class="filter-sidebar">
                    <h4 style="font-weight: 800; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 10px;">
                        <i class="fas fa-filter text-primary"></i> تصفية النتائج
                    </h4>

                    <div class="filter-group">
                        <label>المحافظة</label>
                        <select name="governorate" class="form-control-custom">
                            <option value="">كل المحافظات</option>
                            @foreach ($governorates as $gov)
                                <option value="{{ $gov }}" {{ request('governorate') == $gov ? 'selected' : '' }}>
                                    {{ $gov }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="filter-group">
                        <label>المدينة</label>
                        <select name="city" class="form-control-custom">
                            <option value="">كل المدن</option>
                            @foreach ($cities as $city)
                                <option value="{{ $city }}" {{ request('city') == $city ? 'selected' : '' }}>
                                    {{ $city }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="filter-group">
                        <label>نطاق السعر (بالليلة)</label>
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

                    <button type="submit" class="btn btn-primary w-100"
                        style="padding: 0.8rem; border-radius: 12px; font-weight: 700;">
                        تطبيق الفلتر
                    </button>

                    @if (request()->anyFilled(['governorate', 'city', 'price_min', 'price_max', 'sort']))
                        <a href="{{ route('apartments.index') }}"
                            style="display: block; text-align: center; margin-top: 1rem; color: #64748b; font-size: 0.8rem;">إعادة
                            ضبط</a>
                    @endif
                </form>
            </aside>

            <main>
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

                                <div class="d-flex justify-between align-center" style="margin-top: 1rem;">
                                    <span style="color: var(--primary-color); font-weight: bold; font-size: 1.1rem;">
                                        ${{ $apartment->price_per_night }} / ليلة
                                    </span>

                                    <a href="{{ route('apartments.show', $apartment->slug) }}" class="btn btn-primary"
                                        style="padding: 0.5rem 1rem;">
                                        التفاصيل
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="pagination-wrapper">
                    {{ $apartments->links() }}
                </div>
            </main>
        </div>
    </div>
    <script>
        function updatePriceLabel(val) {
            // تحديث النص الظاهر
            document.getElementById('currentPriceLabel').innerText = val;
            // تحديث القيمة المخفية التي ستُرسل للفورم
            document.getElementById('price_max_hidden').value = val;
        }
    </script>
@endsection
