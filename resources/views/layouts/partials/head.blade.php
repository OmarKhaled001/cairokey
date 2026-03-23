@php
    $siteName       = setting('name',            'Cairo Key');
    $seoTitle       = setting('seo_title',       $siteName);
    $seoDescription = setting('seo_description', 'شركة متخصصة في خدمات السياحة وتأجير الشقق والفنادق والسيارات في مصر');
    $seoKeywords    = setting('seo_keywords');
    $favicon        = setting('favicon');
    $logo           = setting('logo');
@endphp

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">

{{-- Title: child views override via @section('title') --}}
<title>@hasSection('title') @yield('title') — {{ $siteName }} @else {{ $siteName }} @endif</title>

{{-- Description: child views override via @section('description') --}}
<meta name="description"
      content="@hasSection('description') @yield('description') @else {{ $seoDescription }} @endif">

@if ($seoKeywords)
    {{-- Keywords: child views can append via @section('keywords') --}}
    <meta name="keywords"
          content="@hasSection('keywords') @yield('keywords') @else {{ $seoKeywords }} @endif">
@endif

{{-- Open Graph --}}
<meta property="og:type"        content="website">
<meta property="og:site_name"   content="{{ $siteName }}">
<meta property="og:title"       content="@hasSection('title') @yield('title') @else {{ $seoTitle }} @endif">
<meta property="og:description" content="@hasSection('description') @yield('description') @else {{ $seoDescription }} @endif">
<meta property="og:locale"      content="{{ app_locale() === 'ar' ? 'ar_EG' : 'en_US' }}">

@if ($logo)
    <meta property="og:image" content="{{ asset('storage/' . $logo) }}">
@endif

{{-- Favicon --}}
@if ($favicon)
    <link rel="icon" href="{{ asset('storage/' . $favicon) }}">
@endif

{{-- Fonts --}}
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">

{{-- Icons --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

{{-- Core CSS --}}
<link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">

{{-- Vite assets --}}
@vite(['resources/css/app.css', 'resources/js/app.js'])

{{-- Page-specific styles --}}
@stack('styles')


<!-- Snap Pixel Code -->
<script type='text/javascript'>
(function(e,t,n){if(e.snaptr)return;var a=e.snaptr=function()
{a.handleRequest?a.handleRequest.apply(a,arguments):a.queue.push(arguments)};
a.queue=[];var s='script';r=t.createElement(s);r.async=!0;
r.src=n;var u=t.getElementsByTagName(s)[0];
u.parentNode.insertBefore(r,u);})(window,document,
'https://sc-static.net/scevent.min.js');

snaptr('init', 'aa12dd56-0e86-48dd-9efc-e02314a5401b', {});

snaptr('track', 'PAGE_VIEW');

</script>
<!-- End Snap Pixel Code -->