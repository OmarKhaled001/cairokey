@php
    use App\Models\Setting;

    $siteName = Setting::get('name', 'Cairo Key');
    $seoTitle = Setting::get('seo_title', $siteName);
    $seoDescription = Setting::get(
        'seo_description',
        'شركة متخصصة في خدمات السياحة وتأجير الشقق والفنادق والسيارات في مصر',
    );
    $seoKeywords = Setting::get('seo_keywords');
    $favicon = Setting::get('favicon');
    $logo = Setting::get('logo');
@endphp

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">

<title>{{ trim($__env->yieldContent('title', $siteName)) }}</title>

<meta name="description" content="{{ trim($__env->yieldContent('description', $seoDescription)) }}">

@if ($seoKeywords)
    <meta name="keywords" content="{{ $seoKeywords }}">
@endif

{{-- Open Graph --}}
<meta property="og:title" content="{{ $seoTitle }}">
<meta property="og:description" content="{{ $seoDescription }}">
<meta property="og:type" content="website">
<meta property="og:site_name" content="{{ $siteName }}">

@if ($logo)
    <meta property="og:image" content="{{ asset('storage/' . $logo) }}">
@endif

{{-- Favicon --}}
@if ($favicon)
    <link rel="icon" type="image/png" href="{{ asset('storage/' . $favicon) }}">
@endif

<!-- Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">

<!-- Icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<!-- Core CSS -->
<link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/navbar.css') }}">

<!-- Page Specific -->
@vite(['resources/css/app.css', 'resources/js/app.js'])
@stack('styles')
