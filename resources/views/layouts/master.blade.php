<!DOCTYPE html>
<html lang="{{ app_locale() }}" dir="{{ is_rtl() ? 'rtl' : 'ltr' }}">
<head>
    @include('layouts.partials.head')
</head>
<body class="antialiased">

    @include('layouts.partials.navbar')

    <main style="min-height: 80vh;">
        @yield('content')
    </main>

    @include('layouts.partials.footer')

    @include('layouts.partials.scripts')

</body>
</html>
