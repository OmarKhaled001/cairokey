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
            <h1 style="font-size: 3rem; margin-bottom: 1.5rem;">حلتك تبدأ من هنا</h1>
            <p style="font-size: 1.25rem; margin-bottom: 2rem;">شقق فاخرة وتأجير سيارات فخمة بين يديك.</p>
        </div>
    </section>

    <!-- Search/Filter Section -->
    <div class="container" style="position: relative; margin-top: -50px; z-index: 10;">
        <div
            style="background: var(--bg-light); padding: 2rem; border-radius: var(--radius-lg); box-shadow: var(--card-shadow);">
            <form class="d-flex gap-4" style="flex-wrap: wrap;">
                <input type="text" name="location" id="search-location" placeholder="المدينة / المنطقة"
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

            <div class="grid grid-cols-3 gap-4 " style="justify-content: center; align-items: center; ">
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

                <!-- 4. Flights -->
                <div class="card text-center"
                    style="padding: 2rem; background: var(--bg-light); border-radius: var(--radius-lg); box-shadow: var(--card-shadow); transition: transform 0.3s;">
                    <i class="fas fa-plane"
                        style="font-size: 2.5rem; color: var(--primary-color); margin-bottom: 1rem;"></i>
                    <h3 style="font-size: 1.2rem; margin-bottom: 0.5rem;">تذاكر طيران</h3>
                    <p style="color: var(--text-light); font-size: 0.9rem;">عروض حصرية على الرحلات الجوية.</p>
                </div>

                <!-- 5. Airport Services -->
                <div class="card text-center"
                    style="padding: 2rem; background: var(--bg-light); border-radius: var(--radius-lg); box-shadow: var(--card-shadow); transition: transform 0.3s;">
                    <i class="fas fa-luggage-cart"
                        style="font-size: 2.5rem; color: var(--primary-color); margin-bottom: 1rem;"></i>
                    <h3 style="font-size: 1.2rem; margin-bottom: 0.5rem;">خدمات مطار</h3>
                    <p style="color: var(--text-light); font-size: 0.9rem;">تسهيل إجراءات السفر والوصول.</p>
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

    <!-- Latest Apartments Section -->
    <section class="section-padding">
        <div class="container">
            <div class="section-title d-flex justify-between align-center" style="text-align: right; margin-bottom: 2rem;">
                <h2>أحدث الشقق</h2>
                <a href="{{ url('/services#apartments') }}" class="btn btn-primary" style="font-size: 0.9rem;">عرض
                    المزيد</a>
            </div>

            <div class="grid grid-cols-3 gap-4">
                <!-- Apartment 1 -->
                <div
                    style="background: var(--bg-light); border-radius: var(--radius-lg); overflow: hidden; box-shadow: var(--card-shadow);">
                    <div
                        style="height: 250px; background-color: #ddd; background-image: url('https://placehold.co/600x400?text=Apartment+1'); background-size: cover;">
                    </div>
                    <div style="padding: 1.5rem;">
                        <h3>جناح النيل الملكي</h3>
                        <p style="color: var(--text-light); font-size: 0.9rem; margin-bottom: 0.5rem;"><i
                                class="fas fa-map-marker-alt"></i> الزمالك، القاهرة</p>
                        <p style="color: var(--text-light); font-size: 0.9rem;"><i class="fas fa-bed"></i> 3 غرف نوم</p>
                        <div class="d-flex justify-between align-center" style="margin-top: 1rem;">
                            <span style="color: var(--primary-color); font-weight: bold; font-size: 1.1rem;">$150 /
                                ليلة</span>
                            <a href="{{ url('/apartments/1') }}" class="btn btn-primary"
                                style="padding: 0.5rem 1rem;">التفاصيل</a>
                        </div>
                    </div>
                </div>
                <!-- Apartment 2 -->
                <div
                    style="background: var(--bg-light); border-radius: var(--radius-lg); overflow: hidden; box-shadow: var(--card-shadow);">
                    <div
                        style="height: 250px; background-color: #ddd; background-image: url('https://placehold.co/600x400?text=Apartment+2'); background-size: cover;">
                    </div>
                    <div style="padding: 1.5rem;">
                        <h3>شقة الدقي الحديثة</h3>
                        <p style="color: var(--text-light); font-size: 0.9rem; margin-bottom: 0.5rem;"><i
                                class="fas fa-map-marker-alt"></i> الدقي، الجيزة</p>
                        <p style="color: var(--text-light); font-size: 0.9rem;"><i class="fas fa-bed"></i> 2 غرف نوم</p>
                        <div class="d-flex justify-between align-center" style="margin-top: 1rem;">
                            <span style="color: var(--primary-color); font-weight: bold; font-size: 1.1rem;">$100 /
                                ليلة</span>
                            <a href="#" class="btn btn-primary" style="padding: 0.5rem 1rem;">التفاصيل</a>
                        </div>
                    </div>
                </div>
                <!-- Apartment 3 -->
                <div
                    style="background: var(--bg-light); border-radius: var(--radius-lg); overflow: hidden; box-shadow: var(--card-shadow);">
                    <div
                        style="height: 250px; background-color: #ddd; background-image: url('https://placehold.co/600x400?text=Apartment+3'); background-size: cover;">
                    </div>
                    <div style="padding: 1.5rem;">
                        <h3>بنتهاوس التجمع</h3>
                        <p style="color: var(--text-light); font-size: 0.9rem; margin-bottom: 0.5rem;"><i
                                class="fas fa-map-marker-alt"></i> التجمع الخامس</p>
                        <p style="color: var(--text-light); font-size: 0.9rem;"><i class="fas fa-bed"></i> 4 غرف نوم</p>
                        <div class="d-flex justify-between align-center" style="margin-top: 1rem;">
                            <span style="color: var(--primary-color); font-weight: bold; font-size: 1.1rem;">$250 /
                                ليلة</span>
                            <a href="#" class="btn btn-primary" style="padding: 0.5rem 1rem;">التفاصيل</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Latest Cars Section -->
    <section class="section-padding" style="background-color: var(--bg-secondary);">
        <div class="container">
            <div class="section-title d-flex justify-between align-center"
                style="text-align: right; margin-bottom: 2rem;">
                <h2>أحدث السيارات</h2>
                <a href="{{ url('/services#cars') }}" class="btn btn-primary" style="font-size: 0.9rem;">عرض المزيد</a>
            </div>

            <div class="grid grid-cols-3 gap-4">
                <!-- Car 1 -->
                <div
                    style="background: var(--bg-light); border-radius: var(--radius-lg); overflow: hidden; box-shadow: var(--card-shadow);">
                    <div
                        style="height: 250px; background-color: #ddd; background-image: url('https://placehold.co/600x400?text=Mercedes'); background-size: cover;">
                    </div>
                    <div style="padding: 1.5rem;">
                        <h3>مرسيدس E-Class</h3>
                        <p style="color: var(--text-light); font-size: 0.9rem; margin-bottom: 0.5rem;">سيدان فاخرة - موديل
                            2024</p>
                        <div class="d-flex justify-between align-center" style="margin-top: 1rem;">
                            <span style="color: var(--primary-color); font-weight: bold; font-size: 1.1rem;">$200 /
                                يوم</span>
                            <a href="#" class="btn btn-primary" style="padding: 0.5rem 1rem;">التفاصيل</a>
                        </div>
                    </div>
                </div>
                <!-- Car 2 -->
                <div
                    style="background: var(--bg-light); border-radius: var(--radius-lg); overflow: hidden; box-shadow: var(--card-shadow);">
                    <div
                        style="height: 250px; background-color: #ddd; background-image: url('https://placehold.co/600x400?text=BMW'); background-size: cover;">
                    </div>
                    <div style="padding: 1.5rem;">
                        <h3>بي إم دبليو X5</h3>
                        <p style="color: var(--text-light); font-size: 0.9rem; margin-bottom: 0.5rem;">دفع رباعي - موديل
                            2023</p>
                        <div class="d-flex justify-between align-center" style="margin-top: 1rem;">
                            <span style="color: var(--primary-color); font-weight: bold; font-size: 1.1rem;">$280 /
                                يوم</span>
                            <a href="#" class="btn btn-primary" style="padding: 0.5rem 1rem;">التفاصيل</a>
                        </div>
                    </div>
                </div>
                <!-- Car 3 -->
                <div
                    style="background: var(--bg-light); border-radius: var(--radius-lg); overflow: hidden; box-shadow: var(--card-shadow);">
                    <div
                        style="height: 250px; background-color: #ddd; background-image: url('https://placehold.co/600x400?text=Toyota'); background-size: cover;">
                    </div>
                    <div style="padding: 1.5rem;">
                        <h3>تويوتا لاند كروزر</h3>
                        <p style="color: var(--text-light); font-size: 0.9rem; margin-bottom: 0.5rem;">دفع رباعي - موديل
                            2024</p>
                        <div class="d-flex justify-between align-center" style="margin-top: 1rem;">
                            <span style="color: var(--primary-color); font-weight: bold; font-size: 1.1rem;">$300 /
                                يوم</span>
                            <a href="#" class="btn btn-primary" style="padding: 0.5rem 1rem;">التفاصيل</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Reviews Section -->
    <section class="section-padding">
        <div class="container">
            <div class="section-title">
                <h2>آراء عملائنا</h2>
            </div>

            <div class="grid grid-cols-3 gap-4">
                <!-- Review 1 -->
                <div
                    style="background: var(--bg-light); padding: 2rem; border-radius: var(--radius-lg); box-shadow: var(--card-shadow); text-align: center;">
                    <div style="width: 60px; height: 60px; background: #ddd; border-radius: 50%; margin: 0 auto 1rem;">
                    </div>
                    <div style="color: gold; margin-bottom: 1rem;">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i
                            class="fas fa-star"></i><i class="fas fa-star"></i>
                    </div>
                    <p style="font-style: italic; margin-bottom: 1rem; color: var(--text-light);">"تجربة رائعة! الشقة كانت
                        نظيفة جداً والموقع ممتاز. بالتأكيد سأعود مرة أخرى."</p>
                    <h4 style="color: var(--secondary-color);">محمد حسن</h4>
                </div>

                <!-- Review 2 -->
                <div
                    style="background: var(--bg-light); padding: 2rem; border-radius: var(--radius-lg); box-shadow: var(--card-shadow); text-align: center;">
                    <div style="width: 60px; height: 60px; background: #ddd; border-radius: 50%; margin: 0 auto 1rem;">
                    </div>
                    <div style="color: gold; margin-bottom: 1rem;">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i
                            class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>
                    </div>
                    <p style="font-style: italic; margin-bottom: 1rem; color: var(--text-light);">"استأجرت سيارة لمدة
                        أسبوع، الخدمة كانت سريعة والسيارة في حالة ممتازة."</p>
                    <h4 style="color: var(--secondary-color);">سارة أحمد</h4>
                </div>

                <!-- Review 3 -->
                <div
                    style="background: var(--bg-light); padding: 2rem; border-radius: var(--radius-lg); box-shadow: var(--card-shadow); text-align: center;">
                    <div style="width: 60px; height: 60px; background: #ddd; border-radius: 50%; margin: 0 auto 1rem;">
                    </div>
                    <div style="color: gold; margin-bottom: 1rem;">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i
                            class="fas fa-star"></i><i class="far fa-star"></i>
                    </div>
                    <p style="font-style: italic; margin-bottom: 1rem; color: var(--text-light);">"فريق العمل متعاون جداً،
                        ساعدوني في اختيار أفضل مكان لإقامتي."</p>
                    <h4 style="color: var(--secondary-color);">خالد عبدالله</h4>
                </div>
            </div>
        </div>
    </section>
@endsection
