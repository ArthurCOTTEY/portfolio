@props(['title', 'intro'])
@php
    $breadcrumb = [
        '@context' => 'https://schema.org',
        '@type' => 'BreadcrumbList',
        'itemListElement' => [
            ['@type' => 'ListItem', 'position' => 1, 'name' => 'Accueil', 'item' => route('home')],
            ['@type' => 'ListItem', 'position' => 2, 'name' => $title, 'item' => url()->current()],
        ],
    ];
@endphp
<x-json-ld :data="$breadcrumb" />

<section class="border-b-2 border-black bg-yellow-400 p-8 md:p-16" aria-labelledby="page-title">
    <nav aria-label="Fil d’Ariane" class="text-sm">
        <ol class="flex flex-wrap gap-2">
            <li><a href="{{ route('home') }}" class="underline-offset-4 hover:underline">Accueil</a></li>
            <li aria-hidden="true">/</li>
            <li aria-current="page" class="font-semibold">{{ $title }}</li>
        </ol>
    </nav>
    <h1 id="page-title" class="mt-6 font-display text-4xl leading-none font-bold tracking-tight md:text-7xl">{{ $title }}</h1>
    <p class="mt-6 max-w-2xl text-base font-medium md:text-lg">{{ $intro }}</p>
    <p class="mt-4 text-sm">Dernière mise à jour : {{ \Illuminate\Support\Carbon::parse(config('site.legal_updated_at'))->translatedFormat('j F Y') }}</p>
</section>

<section class="border-b-2 border-black bg-white p-8 md:p-16">
    <div class="prose-legal">
        {{ $slot }}
    </div>
</section>
