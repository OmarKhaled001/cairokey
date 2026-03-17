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
