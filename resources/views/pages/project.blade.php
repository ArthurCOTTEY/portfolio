@extends('layouts.app')

@section('title', "{$project->name} — {$project->tagline} | Étude de cas, Arthur Cottey")
@section('description', str($project->description)->limit(155)->toString())
@section('og_type', 'article')

@php
    $url = route('projects.show', $project);
    $personId = route('home').'#arthur-cottey';
    $gallery = $project->galleryItems();
@endphp

@if ($project->image_url)
    @push('head')
        <link rel="preload" as="image" href="{{ $project->image_url }}" fetchpriority="high">
    @endpush
@endif

<x-json-ld :data="[
    '@context' => 'https://schema.org',
    '@graph' => [
        array_filter([
            '@type' => 'TechArticle',
            '@id' => $url.'#article',
            'headline' => $project->name.' — étude de cas',
            'description' => $project->description,
            'url' => $url,
            'inLanguage' => 'fr-FR',
            'image' => $project->image_url,
            'datePublished' => $project->created_at?->toIso8601String(),
            'dateModified' => $project->updated_at?->toIso8601String(),
            'author' => ['@type' => 'Person', '@id' => $personId, 'name' => 'Arthur Cottey', 'url' => route('home')],
            'about' => ['@id' => $url.'#application'],
            'keywords' => $project->stack ? implode(', ', $project->stack) : null,
        ]),
        array_filter([
            '@type' => 'SoftwareApplication',
            '@id' => $url.'#application',
            'name' => $project->name,
            'description' => $project->tagline,
            'url' => $project->url,
            'image' => $project->image_url,
            'applicationCategory' => 'BusinessApplication',
            'operatingSystem' => 'Web',
            'inLanguage' => 'fr-FR',
            'creator' => ['@id' => $personId],
        ]),
        [
            '@type' => 'BreadcrumbList',
            'itemListElement' => [
                ['@type' => 'ListItem', 'position' => 1, 'name' => 'Accueil', 'item' => route('home')],
                ['@type' => 'ListItem', 'position' => 2, 'name' => 'Projets', 'item' => route('home').'#projets'],
                ['@type' => 'ListItem', 'position' => 3, 'name' => $project->name, 'item' => $url],
            ],
        ],
    ],
]" />

@section('content')
    {{-- EN-TÊTE --}}
    <section class="border-b-2 border-black bg-yellow-400 p-8 md:p-16" aria-labelledby="project-title">
        <nav aria-label="Fil d’Ariane" class="text-sm">
            <ol class="flex flex-wrap gap-2">
                <li><a href="{{ route('home') }}" class="underline-offset-4 hover:underline">Accueil</a></li>
                <li aria-hidden="true">/</li>
                <li><a href="{{ route('home') }}#projets" class="underline-offset-4 hover:underline">Projets</a></li>
                <li aria-hidden="true">/</li>
                <li aria-current="page" class="font-semibold">{{ $project->name }}</li>
            </ol>
        </nav>

        <p class="eyebrow mt-8">Étude de cas</p>
        <h1 id="project-title" class="mt-3 font-display font-bold tracking-tight">
            <span class="block text-6xl leading-none md:text-8xl">{{ $project->name }}</span>
            <span class="mt-4 block text-2xl leading-snug md:text-3xl">{{ $project->tagline }}</span>
        </h1>
        <p class="mt-6 max-w-3xl text-base leading-relaxed md:text-lg">{{ $project->description }}</p>

        <div class="mt-8 flex flex-wrap items-center gap-3">
            @if ($project->url)
                <a href="{{ $project->url }}" target="_blank" rel="noopener" class="btn btn-black">
                    Visiter {{ preg_replace('#^https?://(www\.)?#', '', $project->url) }} <span aria-hidden="true">↗</span><span class="sr-only">(nouvel onglet)</span>
                </a>
            @endif
            @if ($project->repository_url)
                <a href="{{ $project->repository_url }}" target="_blank" rel="noopener noreferrer" class="btn btn-white">
                    Code source <span aria-hidden="true">↗</span><span class="sr-only">(nouvel onglet)</span>
                </a>
            @endif
            <span class="inline-flex items-center gap-2 border-2 border-black bg-white px-3 py-2 text-sm font-semibold">
                <span aria-hidden="true" class="h-2.5 w-2.5 {{ $project->status->badgeClass() }} ring-2 ring-black"></span>
                {{ $project->status->getLabel() }}@if ($project->year) · {{ $project->year }}@endif
            </span>
        </div>
    </section>

    {{-- CAPTURE PRINCIPALE --}}
    @if ($project->image_url)
        <div class="border-b-2 border-black bg-gray-100 p-4 md:p-10">
            <figure class="mx-auto max-w-5xl border-2 border-black bg-white shadow-[8px_8px_0_0_#000]">
                <div aria-hidden="true" class="flex items-center gap-2 border-b-2 border-black px-4 py-2">
                    <span class="h-3 w-3 border-2 border-black bg-red-500"></span>
                    <span class="h-3 w-3 border-2 border-black bg-yellow-400"></span>
                    <span class="h-3 w-3 border-2 border-black bg-green-500"></span>
                    @if ($project->url)
                        <span class="ml-3 truncate text-xs text-gray-700">{{ preg_replace('#^https?://#', '', $project->url) }}</span>
                    @endif
                </div>
                <img src="{{ $project->image_url }}" alt="Page d’accueil de {{ $project->name }}" width="1440" height="900"
                     fetchpriority="high" decoding="async" class="w-full">
            </figure>
        </div>
    @endif

    {{-- CHIFFRES --}}
    @if ($project->metrics)
        <section aria-label="Chiffres clés" class="border-b-2 border-black">
            <dl class="grid grid-cols-2 lg:grid-cols-4">
                @foreach ($project->metrics as $metric)
                    <div class="flex flex-col border-black p-6 md:p-8 {{ $loop->odd ? 'border-r-2' : '' }} {{ $loop->index < 2 ? 'border-b-2 lg:border-b-0' : '' }} {{ $loop->index === 1 ? 'lg:border-r-2' : '' }} {{ $loop->last ? 'lg:border-r-0' : '' }}">
                        <dt class="text-sm font-medium text-gray-700">{{ $metric['label'] ?? '' }}</dt>
                        <dd class="order-first font-display text-4xl font-bold md:text-5xl">{{ $metric['value'] ?? '' }}</dd>
                    </div>
                @endforeach
            </dl>
        </section>
    @endif

    {{-- CONTENU --}}
    <div class="grid border-b-2 border-black lg:grid-cols-12">
        <aside class="border-b-2 border-black bg-gray-100 p-8 lg:col-span-4 lg:border-r-2 lg:border-b-0 md:p-10" aria-label="En bref">
            <div class="space-y-8 lg:sticky lg:top-28">
                @if ($project->role)
                    <div>
                        <h2 class="eyebrow">Mon rôle</h2>
                        <p class="mt-2 text-sm font-medium leading-relaxed">{{ $project->role }}</p>
                    </div>
                @endif
                @if ($project->stack)
                    <div>
                        <h2 class="eyebrow">Technologies</h2>
                        <ul class="mt-3 flex flex-wrap gap-2">
                            @foreach ($project->stack as $tech)
                                <li class="border border-black bg-white px-2 py-0.5 text-xs font-medium">{{ $tech }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if ($project->highlights)
                    <div>
                        <h2 class="eyebrow">Points forts</h2>
                        <ul class="mt-3 space-y-2 text-sm">
                            @foreach ($project->highlights as $highlight)
                                <li class="flex gap-2"><span aria-hidden="true" class="mt-1.5 h-2 w-2 shrink-0 bg-yellow-400 ring-2 ring-black"></span>{{ $highlight }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </aside>

        <article class="prose-case p-8 md:p-12 lg:col-span-8 lg:p-16">
            {!! $project->caseStudyHtml() !!}
        </article>
    </div>

    {{-- GALERIE --}}
    @if ($gallery)
        <section class="border-b-2 border-black p-8 md:p-12 lg:p-16" aria-labelledby="gallery-title">
            <h2 id="gallery-title" class="section-title border-yellow-400">En images</h2>
            <div class="mt-10 grid gap-8 md:grid-cols-2">
                @foreach ($gallery as $item)
                    <figure class="border-2 border-black bg-white">
                        <img src="{{ $item['url'] }}" alt="{{ $item['caption'] ?? 'Capture d’écran de '.$project->name }}" width="1200" height="750"
                             loading="lazy" decoding="async" class="aspect-[16/10] w-full border-b-2 border-black object-cover">
                        @if ($item['caption'])
                            <figcaption class="p-4 text-sm">{{ $item['caption'] }}</figcaption>
                        @endif
                    </figure>
                @endforeach
            </div>
        </section>
    @endif

    {{-- APPEL À L’ACTION --}}
    <section class="border-b-2 border-black bg-black p-8 text-white md:p-16" aria-labelledby="cta-title">
        <h2 id="cta-title" class="font-display text-3xl font-bold tracking-tight md:text-5xl">Un projet du même genre ?</h2>
        <p class="mt-4 max-w-2xl text-base leading-relaxed md:text-lg">
            Application sur mesure, plateforme de réservation, back-office ou reprise d’un projet existant : parlons-en.
        </p>
        <div class="mt-8 flex flex-wrap gap-3">
            <a href="{{ route('home') }}#contact" class="btn btn-yellow">Me contacter</a>
            <a href="{{ route('home') }}#projets" class="btn border-white bg-black text-white hover:bg-white hover:text-black">Retour aux projets</a>
        </div>
        @if ($otherProjects->isNotEmpty())
            <p class="mt-10 text-sm">Autres projets :
                @foreach ($otherProjects as $other)
                    <a href="{{ $other->hasCaseStudy() ? route('projects.show', $other) : route('home').'#projet-'.$other->slug }}" class="underline underline-offset-4">{{ $other->name }}</a>@if (! $loop->last), @endif
                @endforeach
            </p>
        @endif
    </section>
@endsection
