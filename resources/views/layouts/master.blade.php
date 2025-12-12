<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    @include('layouts.partials.head')
</head>
<body class="antialiased">
    
    <!-- Navbar -->
    @include('layouts.partials.navbar')

    <!-- Main Content -->
    <main style="min-height: 80vh; padding-top: var(--header-height);">
        @yield('content')
    </main>

    <!-- Footer -->
    @include('layouts.partials.footer')

    <!-- Scripts -->
    @include('layouts.partials.scripts')
</body>
</html>
