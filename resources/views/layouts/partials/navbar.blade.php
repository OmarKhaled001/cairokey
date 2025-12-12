<nav class="navbar">
    <div class="container navbar-container">
        <!-- Logo (Rightmost) -->
        <a href="{{ url('/') }}" class="nav-logo">
            <i class="fas fa-globe-americas"></i> كايرو كي
        </a>

        <!-- Navigation Links (Center/Right Hidden on Mobile) -->
        <div class="nav-menu">
            <a href="{{ url('/') }}" class="nav-link {{ request()->is('/') ? 'active' : '' }}">
                الرئيسية
            </a>

            <!-- Services Dropdown via CSS hover or JS click -->
            <div class="dropdown">
                <a href="#" class="nav-link {{ request()->is('services*') ? 'active' : '' }}">
                    خدماتنا <i class="fas fa-chevron-down" style="font-size: 0.8rem;"></i>
                </a>
                <div class="dropdown-content">
                    <a href="{{ url('/services#apartments') }}"><i class="fas fa-building"></i> شقق</a>
                    <a href="{{ url('/services#hotels') }}"><i class="fas fa-hotel"></i> فنادق</a>
                    <a href="{{ url('/services#cars') }}"><i class="fas fa-car"></i> سيارات</a>
                    <a href="{{ url('/services#flights') }}"><i class="fas fa-plane"></i> تذاكر طيران</a>
                    <a href="{{ url('/services#airport') }}"><i class="fas fa-shuttle-van"></i> خدمات المطار</a>
                </div>
            </div>

            <a href="{{ url('/blog') }}" class="nav-link {{ request()->is('blog') ? 'active' : '' }}">
                المدونة
            </a>
            <a href="{{ url('/contact') }}" class="nav-link {{ request()->is('contact') ? 'active' : '' }}">
                تواصل معنا
            </a>

            <!-- Auth Buttons (Moved inside menu for mobile) -->
            <div class="nav-auth-items">
                @auth('client')
                    <div class="dropdown">
                        <button class="btn btn-primary profile-btn"
                            style="padding: 0.5rem 1rem; display: flex; align-items: center; gap: 0.5rem;">
                            <i class="fas fa-user-circle"></i> حسابي
                        </button>
                        <div class="dropdown-content" style="left:0; right:auto;">
                            <a href="{{ url('/reservations') }}"><i class="fas fa-bookmark" style="margin-left:8px"></i>
                                الحجوزات</a>
                            <a href="{{ url('/profile') }}"><i class="fas fa-cog" style="margin-left:8px"></i>
                                الإعدادات</a>
                            <a href="#"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt" style="margin-left:8px"></i> تسجيل الخروج
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="btn btn-primary">
                        تسجيل الدخول
                    </a>
                @endauth
            </div>
        </div>

        <!-- Mobile Toggle (Leftmost in RTL flow logic requires it to be last in DOM if direction:rtl and justify-between is used, OR manual ordering) -->
        <div class="hamburger">
            <i class="fas fa-bars"></i>
        </div>
    </div>
</nav>
