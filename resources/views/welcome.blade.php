<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>خدمات سياحية فاخرة - الرئيسية</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* ========================================= */
        /* التنسيقات العامة والألوان (CSS Base) */
        /* ========================================= */

        :root {
            --primary-color: #BB9A58; /* اللون الذهبي الفاخر */
            --secondary-color: #0f172a; /* كحلي/شارب أسود */
            --text-dark: #333;
            --bg-light: #ffffff;
            --card-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            font-family: 'Cairo', sans-serif;
            scroll-behavior: smooth;
        }

        body {
            margin: 0;
            padding: 0;
            background-color: var(--bg-light);
            color: var(--text-dark);
            direction: rtl; /* تفعيل اتجاه RTL */
            overflow-x: hidden;
        }

        /* الأزرار (Buttons) */
        .btn-primary {
            background-color: var(--primary-color);
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            transition: background-color 0.3s, transform 0.2s;
            text-decoration: none;
            display: inline-block;
        }

        .btn-primary:hover {
            background-color: #a3854d; /* لون أغمق عند التحويم */
            transform: translateY(-2px);
        }

        h2, h3 {
            color: var(--secondary-color);
            text-align: center;
            font-weight: 700;
        }
        
        /* ========================================= */
        /* شريط التنقل (Navbar) */
        /* ========================================= */

        .navbar {
            position: fixed;
            top: 0;
            right: 0;
            width: 100%;
            background-color: var(--bg-light);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            padding: 15px 5%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            z-index: 1000;
        }

        .navbar-logo {
            font-size: 24px;
            font-weight: bold;
            color: var(--primary-color);
            text-decoration: none;
        }
        .navbar-logo i {
            font-size: 20px;
            margin-left: 5px;
        }

        .navbar-links a {
            color: var(--text-dark);
            text-decoration: none;
            margin: 0 15px;
            font-size: 16px;
            transition: color 0.3s;
        }
        .navbar-links a:hover {
            color: var(--primary-color);
        }
        .navbar-links a i {
            margin-left: 8px; 
            color: var(--primary-color);
        }
        
        /* ========================================= */
        /* القائمة المنسدلة (Profile Dropdown) */
        /* ========================================= */

        .navbar-utilities {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        
        .profile-dropdown {
            position: relative;
            display: inline-block;
        }

        .profile-btn {
            background: none;
            border: none;
            cursor: pointer;
            font-size: 24px;
            color: var(--secondary-color);
            padding: 5px;
            border-radius: 50%;
            transition: color 0.3s;
        }

        .profile-btn:hover {
            color: var(--primary-color);
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: var(--bg-light);
            min-width: 180px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
            border-radius: 8px;
            right: 0; 
            overflow: hidden;
            border: 1px solid #eee;
            margin-top: 10px;
            text-align: right;
        }

        .dropdown-content a {
            color: var(--text-dark);
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            transition: background-color 0.3s, color 0.3s;
            font-size: 15px;
            width: auto;
        }

        .dropdown-content a:hover {
            background-color: #f1f1f1;
            color: var(--primary-color);
        }
        
        .dropdown-content a i {
            margin-left: 10px;
            color: var(--secondary-color);
            transition: color 0.3s;
        }
        
        .dropdown-content a:hover i {
             color: var(--primary-color);
        }

        .show {
            display: block;
        }
        
        /* زر قائمة الهامبرغر (مخفي افتراضياً) */
        .hamburger-menu {
            display: none;
            background: none;
            border: none;
            font-size: 24px;
            cursor: pointer;
            color: var(--secondary-color);
        }

        /* قائمة السايد بار (مخفية افتراضياً) */
        .sidebar {
            height: 100%;
            width: 0; /* عرض مبدئي صفر */
            position: fixed;
            z-index: 2000;
            top: 0;
            right: 0;
            background-color: var(--secondary-color);
            overflow-x: hidden;
            transition: 0.5s;
            padding-top: 60px;
            box-shadow: -4px 0 10px rgba(0, 0, 0, 0.5);
        }

        .sidebar a {
            padding: 15px 30px;
            text-decoration: none;
            font-size: 18px;
            color: white;
            display: block;
            transition: 0.3s;
            text-align: right;
        }

        .sidebar a:hover {
            color: var(--primary-color);
        }

        .sidebar .close-btn {
            position: absolute;
            top: 0;
            right: 25px;
            font-size: 36px;
            margin-left: 50px;
        }


        /* ========================================= */
        /* منطقة البطل والبحث (Hero & Search) */
        /* ========================================= */

        .hero-section {
            height: 70vh;
            background: url('placeholder-city.jpg') no-repeat center center/cover;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            position: relative;
        }

        .hero-overlay {
            background-color: rgba(0, 0, 0, 0.4);
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
        }

        .hero-content {
            z-index: 10;
            color: white;
            max-width: 800px;
            padding-bottom: 80px; 
        }

        .hero-content h1 {
            font-size: 48px;
            margin-bottom: 10px;
        }

        .search-bar {
            position: absolute;
            bottom: -50px; 
            width: 90%;
            max-width: 1100px;
            background-color: var(--bg-light);
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            z-index: 20;
            display: flex;
            gap: 10px;
        }

        .search-bar input, .search-bar select {
            flex-grow: 1;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
            text-align: right;
        }

        .search-bar .btn-primary {
            flex-shrink: 0;
            padding: 12px 30px;
        }
        
        /* ========================================= */
        /* البطاقات والأقسام العامة (Cards & Sections) */
        /* ========================================= */

        section {
            padding: 100px 5% 50px;
            text-align: center;
        }

        .services-grid, .listings-carousel, .reviews-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 30px;
            margin-top: 40px;
            max-width: 1200px;
            margin-left: auto;
            margin-right: auto;
        }

        .card {
            background-color: var(--bg-light);
            border-radius: 12px;
            padding: 30px;
            box-shadow: var(--card-shadow);
            transition: transform 0.3s, box-shadow 0.3s;
            text-align: center;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .card i {
            font-size: 40px;
            color: var(--primary-color);
            margin-bottom: 15px;
        }

        /* قسم الإحصائيات */
        .counters-section {
            background-color: #f7f9fb;
            padding: 80px 5%;
            margin-top: 80px; 
        }

        .counter-item h3 {
            font-size: 40px;
            color: var(--primary-color);
            margin-bottom: 5px;
        }
        .counter-item p {
            font-size: 18px;
            margin: 0;
        }

        /* بطاقات الشقق/السيارات */
        .listing-card {
            background-color: var(--bg-light);
            border-radius: 12px;
            overflow: hidden;
            box-shadow: var(--card-shadow);
            text-align: right;
            transition: transform 0.3s;
        }

        .listing-card-img {
            height: 200px;
            background-color: #eee;
            background-size: cover;
            background-position: center;
        }
        
        .listing-card-body {
            padding: 15px;
        }

        .listing-card-body h4 {
            margin: 0 0 5px 0;
            font-size: 18px;
            color: var(--secondary-color);
        }
        .listing-card-body p.location {
            color: #666;
            font-size: 14px;
            margin-bottom: 10px;
        }
        .listing-card-body .price {
            font-size: 22px;
            font-weight: bold;
            color: var(--primary-color);
            margin-top: 10px;
        }
        .listing-card-body .features-icons {
             display: flex;
             gap: 10px;
             margin-top: 10px;
             font-size: 14px;
             color: #666;
             direction: rtl;
             justify-content: flex-end;
        }
        
        /* ========================================= */
        /* قسم المراجعات (Reviews) */
        /* ========================================= */
        .reviews-section {
            background-color: #f7f9fb;
            padding: 100px 5%;
        }
        
        .review-card {
            background-color: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.08);
            text-align: right;
            transition: transform 0.3s;
        }
        
        .review-card:hover {
            transform: translateY(-5px);
        }

        .review-card p {
            font-style: italic;
            color: #555;
            margin-bottom: 15px;
            font-size: 15px;
        }

        .reviewer-info {
            display: flex;
            align-items: center;
            gap: 15px;
            direction: rtl;
            justify-content: flex-end;
        }

        .reviewer-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background-color: var(--primary-color);
        }
        
        .star-rating {
            color: gold;
            margin-bottom: 10px;
            font-size: 16px;
            direction: rtl;
        }
        
        /* ========================================= */
        /* تذييل الصفحة (Footer) */
        /* ========================================= */

        footer {
            background-color: var(--secondary-color);
            color: white;
            padding: 50px 5%; 
            font-size: 14px;
        }

        .footer-content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 30px;
            max-width: 1200px;
            margin: 0 auto 30px;
        }

        footer h4 {
            color: white;
            margin-bottom: 15px;
            font-size: 16px;
            text-align: right;
        }

        footer ul {
            list-style: none;
            padding: 0;
            margin: 0;
            text-align: right;
        }

        footer ul li a {
            color: #ccc;
            text-decoration: none;
            display: block;
            margin-bottom: 8px;
            transition: color 0.3s;
        }

        footer ul li a:hover {
            color: var(--primary-color);
        }

        .social-icons a {
            color: white;
            font-size: 20px;
            margin-right: 15px;
            transition: color 0.3s;
        }
        .social-icons a:hover {
            color: var(--primary-color);
        }
        .social-icons {
            text-align: right;
        }

        .footer-bottom {
            border-top: 1px solid #333;
            padding-top: 20px;
            text-align: center;
            color: #ccc;
        }

        /* ========================================= */
        /* استجابة الهاتف (Mobile Responsiveness) - التحديث الجديد */
        /* ========================================= */

        @media (max-width: 900px) {
            
            /* إخفاء الروابط الرئيسية على سطح المكتب و إظهار الهامبرغر */
            .navbar-links {
                display: none; 
            }
            .hamburger-menu {
                display: block;
            }
            
            /* ترتيب عناصر النافبار على الموبايل */
            .navbar {
                 padding: 15px 5%;
            }
            .navbar-utilities {
                 /* يتم عكس الترتيب: أيقونة الملف الشخصي ثم زر تسجيل الدخول */
                 order: 3; 
                 gap: 5px;
            }
            .navbar-logo {
                 order: 1;
            }
            .hamburger-menu {
                 order: 2; /* وضع زر الهامبرغر بجوار اللوجو أو في موقع مناسب */
            }

            /* شريط البحث */
            .search-bar {
                flex-direction: column;
                bottom: -150px;
                width: 95%;
            }
            .hero-section {
                 height: 80vh;
            }
            .counters-section {
                margin-top: 200px; 
            }
            
            /* التذييل */
            .footer-content {
                grid-template-columns: 1fr;
                text-align: center;
            }
            footer h4, footer ul, .social-icons {
                text-align: center;
            }
            
            /* القائمة المنسدلة للبروفايل */
            .dropdown-content {
                 right: auto;
                 left: 0; /* لكي تظهر القائمة المنسدلة من اليسار إذا كان الزر على اليسار */
            }
        }
    </style>
</head>
<body>

    <div id="mySidebar" class="sidebar">
        <a href="javascript:void(0)" class="close-btn" onclick="closeNav()">&times;</a>
        <a href="#"><i class="fas fa-home"></i> الرئيسية</a>
        <a href="#"><i class="fas fa-tools"></i> الخدمات</a>
        <a href="#"><i class="fas fa-headset"></i> اتصل بنا</a>
        <hr style="border-color: rgba(255, 255, 255, 0.2); margin: 20px 0;">
        <a href="#" class="btn-primary" style="margin: 0 30px; text-align: center;">تسجيل الدخول / التسجيل</a>
    </div>

    <nav class="navbar">
        <a href="#" class="navbar-logo"><i class="fas fa-globe-americas" style="color: var(--primary-color);"></i> ترافل لوكس</a>
        
        <button class="hamburger-menu" onclick="openNav()">
            &#9776;
        </button>
        
        <div class="navbar-links">
            <a href="#"><i class="fas fa-home"></i> الرئيسية</a>
            <a href="#"><i class="fas fa-tools"></i> الخدمات</a>
            <a href="#"><i class="fas fa-headset"></i> اتصل بنا</a>
        </div>
        

        <div class="navbar-utilities">
            <div class="profile-dropdown">
                <button class="profile-btn" onclick="toggleDropdown()">
                    <i class="fas fa-user-circle"></i>
                </button>
                <div class="dropdown-content" id="profileDropdown">
                    <a href="#"><i class="fas fa-cog"></i> الإعدادات</a>
                    <a href="#"><i class="fas fa-bookmark"></i> حجوزاتي</a>
                    <a href="#"><i class="fas fa-sign-out-alt"></i> تسجيل الخروج</a>
                </div>
            </div>
            
            <a href="#" class="btn-primary login-btn">تسجيل الدخول / التسجيل</a>
        </div>
    </nav>

    <header class="hero-section">
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <h1>رحلتك القادمة تبدأ هنا... اكتشف العالم بين يديك</h1>
        </div>

        <div class="search-bar">
            <input type="text" placeholder="المدينة / الوجهة" required>
            <button class="btn-primary">ابحث الآن</button>
        </div>
    </header>

    <section class="services-section">
        <h2>خدماتنا الشاملة</h2>
        <div class="services-grid">
            <div class="card">
                <i class="fas fa-building"></i>
                <h3>حجز الشقق الفندقية</h3>
                <p>خيارات إقامة فاخرة ومريحة في قلب أجمل المدن العالمية.</p>
            </div>
            <div class="card">
                <i class="fas fa-car"></i>
                <h3>تأجير السيارات</h3>
                <p>مجموعة واسعة من السيارات الحديثة لتنقل مريح وحر.</p>
            </div>
            <div class="card">
                <i class="fas fa-concierge-bell"></i>
                <h3>خدمات سياحية متكاملة</h3>
                <p>مرشدون، تحويلات، وحجوزات فعاليات لتجربة متكاملة.</p>
            </div>
        </div>
    </section>

    <section class="counters-section">
        <h2>لماذا تختارنا؟</h2>
        <div class="services-grid">
            <div class="counter-item">
                <h3 data-target="20000">0</h3>
                <p>عميل سعيد</p>
            </div>
            <div class="counter-item">
                <h3 data-target="10">0</h3>
                <p>دول مخدومة</p>
            </div>
            <div class="counter-item">
                <h3 data-target="50000">0</h3>
                <p>رحلة مكتملة</p>
            </div>
        </div>
    </section>

    <section>
        <h2>أحدث الشقق المضافة</h2>
        <div class="listings-carousel services-grid">
            <div class="listing-card">
                <div class="listing-card-img" style="background-image: url('placeholder-apt1.jpg');"></div>
                <div class="listing-card-body">
                    <h4>شقة فاخرة بإطلالة بحرية</h4>
                    <p class="location"><i class="fas fa-map-marker-alt"></i> وسط المدينة، إسطنبول</p>
                    <div>
                        <i class="fas fa-star" style="color: gold;"></i> 4.9 (120 تقييم)
                    </div>
                    <p class="price">150$ / الليلة</p>
                    <a href="#" class="btn-primary" style="width: 100%; margin-top: 10px;">عرض التفاصيل</a>
                </div>
            </div>
            <div class="listing-card">
                <div class="listing-card-img" style="background-image: url('placeholder-apt2.jpg');"></div>
                <div class="listing-card-body">
                    <h4>استوديو عصري هادئ</h4>
                    <p class="location"><i class="fas fa-map-marker-alt"></i> حي الأزهار، باريس</p>
                    <div>
                        <i class="fas fa-star" style="color: gold;"></i> 4.5 (85 تقييم)
                    </div>
                    <p class="price">110$ / الليلة</p>
                    <a href="#" class="btn-primary" style="width: 100%; margin-top: 10px;">عرض التفاصيل</a>
                </div>
            </div>
            <div class="listing-card">
                <div class="listing-card-img" style="background-image: url('placeholder-apt3.jpg');"></div>
                <div class="listing-card-body">
                    <h4>فيلا خاصة بمسبح</h4>
                    <p class="location"><i class="fas fa-map-marker-alt"></i> شواطئ كانكون، المكسيك</p>
                    <div>
                        <i class="fas fa-star" style="color: gold;"></i> 5.0 (22 تقييم)
                    </div>
                    <p class="price">350$ / الليلة</p>
                    <a href="#" class="btn-primary" style="width: 100%; margin-top: 10px;">عرض التفاصيل</a>
                </div>
            </div>
        </div>
    </section>

    <section>
        <h2>أحدث السيارات المتوفرة للإيجار</h2>
        <div class="listings-carousel services-grid">
            <div class="listing-card">
                <div class="listing-card-img" style="background-image: url('placeholder-car1.jpg');"></div>
                <div class="listing-card-body">
                    <h4>مرسيدس E-Class</h4>
                    <p class="location">فئة فاخرة - 2023</p>
                    <div class="features-icons">
                        <span> أوتوماتيك <i class="fas fa-cog"></i></span>
                        <span> 5 ركاب <i class="fas fa-user-friends"></i></span>
                    </div>
                    <p class="price">75$ / اليوم</p>
                    <a href="#" class="btn-primary" style="width: 100%; margin-top: 10px;">عرض التفاصيل</a>
                </div>
            </div>
            <div class="listing-card">
                <div class="listing-card-img" style="background-image: url('placeholder-car2.jpg');"></div>
                <div class="listing-card-body">
                    <h4>تويوتا كورولا</h4>
                    <p class="location">اقتصادية - 2024</p>
                    <div class="features-icons">
                        <span> أوتوماتيك <i class="fas fa-cog"></i></span>
                        <span> 4 ركاب <i class="fas fa-user-friends"></i></span>
                    </div>
                    <p class="price">35$ / اليوم</p>
                    <a href="#" class="btn-primary" style="width: 100%; margin-top: 10px;">عرض التفاصيل</a>
                </div>
            </div>
            <div class="listing-card">
                <div class="listing-card-img" style="background-image: url('placeholder-car3.jpg');"></div>
                <div class="listing-card-body">
                    <h4>فان عائلي سعة كبيرة</h4>
                    <p class="location">7 مقاعد - 2022</p>
                    <div class="features-icons">
                        <span> أوتوماتيك <i class="fas fa-cog"></i></span>
                        <span> 7 ركاب <i class="fas fa-user-friends"></i></span>
                    </div>
                    <p class="price">90$ / اليوم</p>
                    <a href="#" class="btn-primary" style="width: 100%; margin-top: 10px;">عرض التفاصيل</a>
                </div>
            </div>
        </div>
        
    </section>
    
    <section class="reviews-section">
        <h2>ماذا يقول عملاؤنا؟</h2>
        <div class="reviews-grid">
            <div class="review-card">
                <div class="star-rating">
                    <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                </div>
                <p>"تجربة حجز الشقة كانت سلسة وممتازة، والشقة تفوق الوصف من حيث النظافة والموقع. خدمة عملاء احترافية وسريعة الاستجابة."</p>
                <div class="reviewer-info">
                    <span>محمد العتيبي</span>
                    <div class="reviewer-avatar"></div>
                </div>
            </div>
            <div class="review-card">
                <div class="star-rating">
                    <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>
                </div>
                <p>"السيارة التي استأجرتها كانت جديدة تماماً. عملية الاستلام والتسليم كانت سهلة جداً. أنصح بالتعامل معهم بالتأكيد."</p>
                <div class="reviewer-info">
                    <span>فاطمة الزهراني</span>
                    <div class="reviewer-avatar"></div>
                </div>
            </div>
            <div class="review-card">
                <div class="star-rating">
                    <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i>
                </div>
                <p>"شكراً جزيلاً لخدمات التحويل من المطار، كانت مريحة وفي الوقت المحدد. وفرت علينا عناء البحث عن تاكسي."</p>
                <div class="reviewer-info">
                    <span>أحمد قاسم</span>
                    <div class="reviewer-avatar"></div>
                </div>
            </div>
        </div>
    </section>

    <footer>
        <div class="footer-content">
            <div>
                <h4>عن الموقع</h4>
                <p>منصتك المتكاملة لحجز الشقق وتأجير السيارات والخدمات السياحية في وجهتك القادمة، نسعى لراحتك وتميز تجربتك.</p>
            </div>
            <div>
                <h4>روابط سريعة</h4>
                <ul>
                    <li><a href="#">الخدمات</a></li>
                    <li><a href="#">الأسئلة الشائعة</a></li>
                    <li><a href="#">سياسة الخصوصية</a></li>
                </ul>
            </div>
            <div>
                <h4>اتصل بنا</h4>
                <ul>
                    <li><i class="fas fa-map-marker-alt"></i> المملكة العربية السعودية</li>
                    <li><i class="fas fa-phone"></i> +966 50 123 4567</li>
                    <li><i class="fas fa-envelope"></i> info@yourdomain.com</li>
                </ul>
            </div>
            <div>
                <h4>تابعنا</h4>
                <div class="social-icons">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            &copy; 2024 اسم الموقع. جميع الحقوق محفوظة.
        </div>
    </footer>

    <script>
        // 1. دالة لإظهار وإخفاء القائمة المنسدلة للبروفايل
        function toggleDropdown() {
            document.getElementById("profileDropdown").classList.toggle("show");
        }

        // إغلاق القائمة إذا نقر المستخدم خارجها
        window.onclick = function(event) {
            if (!event.target.matches('.profile-btn') && !event.target.closest('.profile-btn')) {
                var dropdowns = document.getElementsByClassName("dropdown-content");
                for (let i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
                    if (openDropdown.classList.contains('show')) {
                        openDropdown.classList.remove('show');
                    }
                }
            }
        }
        
        // 2. دوال قائمة السايد بار (Hamburger Menu)
        function openNav() {
            // يتم فتح السايد بار بعرض 80% من الشاشة على الموبايل
            document.getElementById("mySidebar").style.width = "80%";
        }

        function closeNav() {
            document.getElementById("mySidebar").style.width = "0";
        }
        
        // 3. دالة العداد التصاعدي (Count-up Animation)
        const counters = document.querySelectorAll('.counter-item h3');
        const speed = 200; 

        const animateCounter = (counter) => {
            const target = +counter.getAttribute('data-target');
            let count = 0;
            
            const updateCount = () => {
                const increment = target / speed;
                if (count < target) {
                    count += increment;
                    counter.innerText = Math.ceil(count).toLocaleString('ar-EG') + (target > 1000 ? '+' : '');
                    setTimeout(updateCount, 1);
                } else {
                    counter.innerText = target.toLocaleString('ar-EG') + (target > 1000 ? '+' : '');
                }
            };
            updateCount();
        };

        const countersSection = document.querySelector('.counters-section');
        const observer = new IntersectionObserver(entries => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    counters.forEach(animateCounter);
                    observer.unobserve(entry.target); 
                }
            });
        }, { threshold: 0.5 });

        observer.observe(countersSection);
    </script>
</body>
</html>