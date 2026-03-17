<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>خدمات سياحية فاخرة - الرئيسية</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
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