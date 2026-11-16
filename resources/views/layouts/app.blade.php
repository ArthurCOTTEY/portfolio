@php
    $title = trim($__env->yieldContent('title')) ?: config('site.name').' — '.config('site.tagline');
    $description = trim($__env->yieldContent('description')) ?: config('site.description');
    $canonical = trim($__env->yieldContent('canonical')) ?: url()->current();
    $ogImage = asset('images/og-image.png');
@endphp
<!DOCTYPE html>
<html lang="fr-FR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }}</title>
    <meta name="description" content="{{ $description }}">
    <meta name="author" content="{{ config('site.name') }}">
    <meta name="robots" content="@yield('robots', 'index, follow, max-image-preview:large, max-snippet:-1')">
    <link rel="canonical" href="{{ $canonical }}">
    <meta name="theme-color" content="#facc15">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Open Graph / réseaux sociaux --}}
    <meta property="og:type" content="@yield('og_type', 'website')">
    <meta property="og:locale" content="fr_FR">
    <meta property="og:site_name" content="{{ config('site.name') }}">
    <meta property="og:title" content="{{ $title }}">
    <meta property="og:description" content="{{ $description }}">
    <meta property="og:url" content="{{ $canonical }}">
    <meta property="og:image" content="{{ $ogImage }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt" content="{{ config('site.name') }} — {{ config('site.tagline') }}">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $title }}">
    <meta name="twitter:description" content="{{ $description }}">
    <meta name="twitter:image" content="{{ $ogImage }}">

    {{-- Icônes --}}
    <link rel="icon" href="{{ asset('favicon.ico') }}" sizes="32x32">
    <link rel="icon" href="{{ asset('favicon.svg') }}" type="image/svg+xml">
    <link rel="apple-touch-icon" href="{{ asset('apple-touch-icon.png') }}">
    <link rel="manifest" href="{{ asset('site.webmanifest') }}">

    {{-- Ressources pour les assistants IA --}}
    <link rel="alternate" type="text/plain" href="{{ route('llms') }}" title="Résumé du site pour les IA (llms.txt)">

    @production
        @if (config('site.analytics.google_site_verification'))
            <meta name="google-site-verification" content="{{ config('site.analytics.google_site_verification') }}">
        @endif
    @endproduction

    @stack('head')

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('jsonld')
</head>
<body>
<a href="#contenu" class="sr-only focus:not-sr-only focus:fixed focus:top-3 focus:left-3 focus:z-[100] focus:bg-yellow-400 focus:px-4 focus:py-2 focus:font-semibold focus:outline-2">
    Aller au contenu
</a>

<div class="flex min-h-screen justify-center px-3 md:px-6">
    <div class="w-full max-w-7xl border-x-2 border-black">
        @include('partials.header')

        <main id="contenu" tabindex="-1" class="outline-none">
            @yield('content')
        </main>

        @include('partials.footer')
    </div>
</div>

<div id="toast" role="status" aria-live="polite" hidden
     class="fixed bottom-6 left-1/2 z-[70] w-[calc(100%-2rem)] max-w-md -translate-x-1/2 translate-y-4 border-2 border-black px-5 py-4 text-sm font-medium opacity-0 shadow-[4px_4px_0_0_#000] transition duration-300
            data-[type=success]:bg-green-500 data-[type=error]:bg-red-600 data-[type=error]:text-white"></div>

@include('partials.cookie-consent')
</body>
</html>
