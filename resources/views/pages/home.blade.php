@extends('layouts.app')

@section('title', 'Arthur Cottey — Développeur web full stack PHP & Laravel à Tours')

@push('head')
    <link rel="preload" as="image" href="{{ asset('storage/image_hero.webp') }}" fetchpriority="high">
@endpush

@php
    $services = config('content.services');
    $experience = config('content.experience');
    $faq = config('content.faq');
    $skillNames = $skillCategories->flatMap->skills->pluck('name')->unique()->values();
    $personId = route('home').'#arthur-cottey';
@endphp

<x-json-ld :data="[
    '@context' => 'https://schema.org',
    '@graph' => [
        [
            '@type' => 'WebSite',
            '@id' => route('home').'#website',
            'url' => route('home'),
            'name' => config('site.name'),
            'description' => config('site.description'),
            'inLanguage' => 'fr-FR',
            'publisher' => ['@id' => $personId],
        ],
        [
            '@type' => 'ProfilePage',
            '@id' => route('home').'#profile',
            'url' => route('home'),
            'name' => 'Arthur Cottey — '.config('site.tagline'),
            'inLanguage' => 'fr-FR',
            'isPartOf' => ['@id' => route('home').'#website'],
            'mainEntity' => ['@id' => $personId],
            'dateModified' => now()->toDateString(),
        ],
        [
            '@type' => 'Person',
            '@id' => $personId,
            'name' => 'Arthur Cottey',
            'givenName' => 'Arthur',
            'familyName' => 'Cottey',
            'jobTitle' => config('site.job_title'),
            'description' => config('site.description'),
            'url' => route('home'),
            'image' => asset('images/og-image.png'),
            'email' => 'mailto:'.config('site.email'),
            'sameAs' => [config('site.linkedin')],
            'address' => [
                '@type' => 'PostalAddress',
                'addressLocality' => config('site.location.city'),
                'addressRegion' => config('site.location.region'),
                'addressCountry' => config('site.location.country'),
            ],
            'knowsLanguage' => ['fr'],
            'knowsAbout' => $skillNames->merge(['Développement web', 'PHP', 'Laravel', 'Vue.js', 'Nuxt', 'SEO technique'])->unique()->values()->all(),
            'hasCredential' => [
                ['@type' => 'EducationalOccupationalCredential', 'name' => 'BTS SIO option SLAM', 'credentialCategory' => 'Brevet de technicien supérieur'],
                ['@type' => 'EducationalOccupationalCredential', 'name' => 'Bac Pro Systèmes Numériques', 'credentialCategory' => 'Baccalauréat professionnel'],
            ],
            'hasOccupation' => [
                '@type' => 'Occupation',
                'name' => config('site.job_title'),
                'occupationLocation' => ['@type' => 'City', 'name' => config('site.location.city')],
                'skills' => $skillNames->implode(', '),
            ],
        ],
        [
            '@type' => 'FAQPage',
            '@id' => route('home').'#faq',
            'mainEntity' => collect($faq)->map(fn ($item) => [
                '@type' => 'Question',
                'name' => $item['question'],
                'acceptedAnswer' => ['@type' => 'Answer', 'text' => $item['answer']],
            ])->all(),
        ],
    ],
]" />

@section('content')
    {{-- HERO --}}
    <section class="border-b-2 border-black" aria-labelledby="hero-title">
        <div class="grid md:grid-cols-2">
            <div class="flex flex-col justify-center border-b-2 border-black bg-yellow-400 p-8 md:border-r-2 md:border-b-0 md:p-12">
                <p class="eyebrow">Tours · Centre-Val de Loire</p>
                <h1 id="hero-title" class="mt-4 font-display font-bold tracking-tight">
                    <span class="block text-6xl leading-none uppercase md:text-8xl">Arthur<br>Cottey</span>
                    <span class="mt-6 block text-xl leading-snug md:text-2xl">Développeur web full stack PHP&nbsp;&amp;&nbsp;Laravel</span>
                </h1>
                <p class="mt-6 max-w-lg text-base leading-relaxed">
                    Je conçois et développe des applications web performantes — du site vitrine au CRM en passant par
                    l’e-commerce — avec une exigence particulière sur la qualité du code, la structure des projets et
                    l’expérience de celles et ceux qui les utilisent au quotidien.
                </p>
                <div class="mt-8 flex flex-wrap gap-3">
                    <a href="#contact" class="btn btn-black">Me contacter</a>
                    <a href="#parcours" class="btn btn-white">Voir mon parcours</a>
                </div>
            </div>
            <div class="h-72 bg-gray-100 md:h-full">
                <img src="{{ asset('storage/image_hero.webp') }}"
                     alt="Arthur Cottey, développeur web full stack à Tours"
                     width="638" height="456" fetchpriority="high" decoding="async"
                     class="h-full w-full object-cover">
            </div>
        </div>
    </section>

    {{-- À PROPOS --}}
    <section id="a-propos" class="border-b-2 border-black" aria-labelledby="about-title">
        <div class="grid md:grid-cols-12">
            <div class="order-2 h-72 border-t-2 border-black bg-gray-100 md:order-1 md:col-span-4 md:h-full md:border-t-0 md:border-r-2 lg:col-span-3">
                <img src="{{ asset('storage/image_about.webp') }}"
                     alt="Souvenir de Liverpool, ville du club dont Arthur est supporter"
                     width="317" height="596" loading="lazy" decoding="async"
                     class="h-full w-full object-cover">
            </div>
            <div class="order-1 p-8 md:order-2 md:col-span-8 md:p-16 lg:col-span-9">
                <h2 id="about-title" class="section-title border-yellow-400">À propos</h2>
                <div class="mt-10 max-w-3xl space-y-6 text-base leading-relaxed md:text-lg">
                    <p>
                        Je m’appelle <strong>Arthur Cottey</strong>, je suis développeur web full stack à Tours, spécialisé
                        en <strong>PHP et Laravel</strong>. Aujourd’hui en CDI dans une agence web, je développe des
                        applications sur mesure pour des clients aux besoins très différents, de la première ligne de code
                        jusqu’à la mise en production.
                    </p>
                    <p>
                        J’aime les projets où il faut comprendre un métier avant d’écrire du code : un CRM qui colle aux
                        habitudes d’une équipe, une boutique en ligne qui doit rester rapide, un back-office que l’on
                        prend plaisir à utiliser. Je privilégie les solutions simples, lisibles et testées, qui pourront
                        évoluer sans tout réécrire.
                    </p>
                    <p>
                        En dehors du développement, je joue au football en club — une école de rigueur et d’esprit
                        d’équipe que je retrouve dans mon travail. Grand supporter du Liverpool FC, j’aime aussi voyager
                        pour découvrir d’autres cultures : une curiosité qui nourrit ma façon d’aborder chaque projet.
                    </p>
                </div>
                <dl class="mt-10 grid max-w-3xl gap-4 sm:grid-cols-3">
                    <div class="border-2 border-black p-4">
                        <dt class="eyebrow text-gray-700">Poste</dt>
                        <dd class="mt-1 font-display text-lg font-bold">Full stack en CDI</dd>
                    </div>
                    <div class="border-2 border-black p-4">
                        <dt class="eyebrow text-gray-700">Spécialité</dt>
                        <dd class="mt-1 font-display text-lg font-bold">PHP · Laravel</dd>
                    </div>
                    <div class="border-2 border-black p-4">
                        <dt class="eyebrow text-gray-700">Localisation</dt>
                        <dd class="mt-1 font-display text-lg font-bold">Tours (37)</dd>
                    </div>
                </dl>
            </div>
        </div>
    </section>

    {{-- BANDEAU LINKEDIN --}}
    <a href="{{ config('site.linkedin') }}" target="_blank" rel="me noopener noreferrer" class="group block bg-green-500 text-black">
        <span class="sr-only">Voir mon profil LinkedIn (nouvel onglet)</span>
        <x-marquee text="Voir mon profil LinkedIn ↗" duration="50s" class="group-hover:bg-black group-hover:text-white" />
    </a>

    {{-- SERVICES --}}
    <section id="services" class="border-b-2 border-black" aria-labelledby="services-title">
        <div class="p-8 md:p-12 lg:p-16">
            <div class="max-w-3xl">
                <h2 id="services-title" class="section-title border-black">Ce que je fais</h2>
                <p class="mt-6 text-base leading-relaxed md:text-lg">
                    Du besoin initial à la maintenance, j’accompagne les projets web sur toute leur durée de vie.
                    Trois types de missions reviennent le plus souvent :
                </p>
            </div>
            <div class="mt-10 grid gap-6 md:grid-cols-3">
                @foreach ($services as $service)
                    <article class="flex flex-col border-2 border-black p-6 shadow-[6px_6px_0_0_#000]">
                        <p class="font-display text-sm font-bold text-gray-700">0{{ $loop->iteration }}</p>
                        <h3 class="mt-2 font-display text-2xl font-bold tracking-tight">{{ $service['title'] }}</h3>
                        <p class="mt-3 text-sm leading-relaxed text-gray-800">{{ $service['text'] }}</p>
                        <ul class="mt-5 space-y-2 border-t-2 border-black pt-5 text-sm">
                            @foreach ($service['points'] as $point)
                                <li class="flex gap-2"><span aria-hidden="true" class="mt-1.5 h-2 w-2 shrink-0 bg-yellow-400 ring-2 ring-black"></span>{{ $point }}</li>
                            @endforeach
                        </ul>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    {{-- COMPÉTENCES --}}
    <section id="competences" class="border-b-2 border-black bg-white" aria-labelledby="skills-title">
        <div class="p-8 md:p-12 lg:p-16">
            <div class="max-w-3xl">
                <h2 id="skills-title" class="section-title border-green-500">Ce que je maîtrise</h2>
                <p class="mt-6 text-base leading-relaxed md:text-lg">
                    J’utilise au quotidien <strong>PHP, Laravel, Vue.js et Nuxt</strong> pour concevoir des applications
                    performantes et maintenables. Je reste attentif aux bonnes pratiques — tests, accessibilité, sécurité,
                    performances — et je choisis les outils en fonction du projet, pas l’inverse.
                </p>
            </div>

            @if ($skillCategories->isNotEmpty())
                <div class="mt-10 grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                    @foreach ($skillCategories as $category)
                        <article class="border-2 border-black bg-gray-100 p-6">
                            <h3 class="font-display text-xl font-bold tracking-tight">{{ $category->name }}</h3>
                            @if ($category->description)
                                <p class="mt-2 text-sm text-gray-700">{{ $category->description }}</p>
                            @endif
                            @if ($category->skills->isNotEmpty())
                                <ul class="mt-5 flex flex-wrap gap-2" aria-label="Technologies {{ $category->name }}">
                                    @foreach ($category->skills as $skill)
                                        <x-skill-icon :skill="$skill" />
                                    @endforeach
                                </ul>
                            @endif
                        </article>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    {{-- CITATION --}}
    <section class="border-b-2 border-black bg-blue-600 text-white" aria-label="Ma vision">
        <figure class="mx-auto max-w-4xl p-10 text-center md:p-16">
            <blockquote class="font-display text-2xl font-bold tracking-tight md:text-4xl">
                « J’aime concevoir des expériences web simples, efficaces et utiles. »
            </blockquote>
            <figcaption class="mt-4 text-base">
                Toujours en quête de nouveaux défis techniques et d’occasions d’apprendre et de progresser.
            </figcaption>
        </figure>
    </section>

    {{-- PARCOURS --}}
    <section id="parcours" class="border-b-2 border-black bg-white" aria-labelledby="experience-title">
        <div class="p-8 md:p-12 lg:p-16">
            <div class="max-w-3xl">
                <h2 id="experience-title" class="section-title border-blue-600">Parcours</h2>
                <p class="mt-6 text-base leading-relaxed md:text-lg">
                    Du Bac Pro Systèmes Numériques au poste de développeur full stack en agence web, en passant par un
                    BTS SIO en alternance : un parcours construit pas à pas, toujours au contact de projets concrets.
                </p>
            </div>

            <ol class="mt-12 max-w-4xl border-l-2 border-black">
                @foreach ($experience as $item)
                    <li class="relative pb-10 pl-8 last:pb-0">
                        <span aria-hidden="true" class="absolute top-1 left-0 h-4 w-4 -translate-x-[calc(50%+1px)] border-2 border-black {{ $item['color'] }}"></span>
                        <p class="eyebrow text-gray-700">{{ $item['period'] }}</p>
                        <h3 class="mt-1 font-display text-xl font-bold md:text-2xl">{{ $item['title'] }}</h3>
                        <p class="mt-3 max-w-3xl text-sm leading-relaxed text-gray-800 md:text-base">{{ $item['text'] }}</p>
                        <ul class="mt-4 flex flex-wrap gap-2" aria-label="Mots-clés">
                            @foreach ($item['tags'] as $tag)
                                <li class="border border-black px-2 py-0.5 text-xs font-medium">{{ $tag }}</li>
                            @endforeach
                        </ul>
                    </li>
                @endforeach
            </ol>
        </div>
    </section>

    {{-- FAQ --}}
    <section id="faq" class="border-b-2 border-black bg-gray-100" aria-labelledby="faq-title">
        <div class="grid gap-10 p-8 md:grid-cols-12 md:p-12 lg:p-16">
            <div class="md:col-span-4">
                <h2 id="faq-title" class="section-title border-yellow-400">Questions fréquentes</h2>
                <p class="mt-6 text-base leading-relaxed">L’essentiel en quelques réponses.</p>
            </div>
            <div class="space-y-4 md:col-span-8">
                @foreach ($faq as $item)
                    <details class="group border-2 border-black bg-white" @if ($loop->first) open @endif>
                        <summary class="flex cursor-pointer list-none items-center justify-between gap-4 p-5 font-display text-lg font-bold [&::-webkit-details-marker]:hidden">
                            <h3>{{ $item['question'] }}</h3>
                            <span aria-hidden="true" class="flex h-8 w-8 shrink-0 items-center justify-center border-2 border-black transition group-open:rotate-45">+</span>
                        </summary>
                        <p class="border-t-2 border-black p-5 text-base leading-relaxed">{{ $item['answer'] }}</p>
                    </details>
                @endforeach
            </div>
        </div>
    </section>

    {{-- CONTACT --}}
    <section id="contact" class="border-b-2 border-black" aria-labelledby="contact-title">
        <div class="grid md:grid-cols-12">
            <div class="border-b-2 border-black bg-yellow-400 p-8 md:col-span-5 md:border-r-2 md:border-b-0 md:p-12 lg:col-span-4">
                <h2 id="contact-title" class="font-display text-4xl font-bold tracking-tight uppercase md:text-5xl">Contact</h2>
                <p class="mt-6 text-base leading-relaxed">
                    Une opportunité, un projet, une question technique ou simplement l’envie d’échanger autour du
                    développement web ? Écrivez-moi, je vous réponds au plus vite.
                </p>
                <ul class="mt-8 space-y-3 text-base font-medium">
                    <li><a href="mailto:{{ config('site.email') }}" class="break-all underline underline-offset-4 hover:bg-black hover:text-white">{{ config('site.email') }}</a></li>
                    <li><a href="{{ config('site.linkedin') }}" target="_blank" rel="me noopener noreferrer" class="underline underline-offset-4 hover:bg-black hover:text-white">LinkedIn <span class="sr-only">(nouvel onglet)</span>↗</a></li>
                    <li>Basé à Tours (Indre-et-Loire)</li>
                </ul>
            </div>

            <div class="bg-white p-8 md:col-span-7 md:p-12 lg:col-span-8">
                @if (session('contact.success'))
                    <p role="status" class="mb-6 border-2 border-black bg-green-500 p-4 font-medium">{{ session('contact.success') }}</p>
                @elseif (session('contact.error'))
                    <p role="alert" class="mb-6 border-2 border-black bg-red-600 p-4 font-medium text-white">{{ session('contact.error') }}</p>
                @endif

                <form id="contact-form" method="POST" action="{{ route('contact.store') }}" class="space-y-6" novalidate>
                    @csrf

                    @foreach ([
                        'name' => ['label' => 'Nom', 'type' => 'text', 'autocomplete' => 'name'],
                        'email' => ['label' => 'Adresse e-mail', 'type' => 'email', 'autocomplete' => 'email'],
                    ] as $field => $options)
                        <div>
                            <label for="{{ $field }}" class="mb-1 block text-sm font-semibold">
                                {{ $options['label'] }} <span aria-hidden="true" class="text-red-600">*</span>
                            </label>
                            <input id="{{ $field }}" name="{{ $field }}" type="{{ $options['type'] }}" autocomplete="{{ $options['autocomplete'] }}"
                                   value="{{ old($field) }}" required maxlength="{{ $field === 'name' ? 100 : 255 }}"
                                   aria-describedby="{{ $field }}-error" @error($field) aria-invalid="true" @enderror
                                   class="field">
                            <p id="{{ $field }}-error" data-error-for="{{ $field }}" class="mt-1 text-sm font-medium text-red-700" @error($field) @else hidden @enderror>
                                @error($field){{ $message }}@enderror
                            </p>
                        </div>
                    @endforeach

                    <div>
                        <label for="message" class="mb-1 block text-sm font-semibold">
                            Message <span aria-hidden="true" class="text-red-600">*</span>
                        </label>
                        <textarea id="message" name="message" rows="6" required minlength="10" maxlength="5000"
                                  aria-describedby="message-error" @error('message') aria-invalid="true" @enderror
                                  class="field">{{ old('message') }}</textarea>
                        <p id="message-error" data-error-for="message" class="mt-1 text-sm font-medium text-red-700" @error('message') @else hidden @enderror>
                            @error('message'){{ $message }}@enderror
                        </p>
                    </div>

                    {{-- Piège à robots : invisible pour les humains. --}}
                    <div class="absolute -left-[9999px]" aria-hidden="true">
                        <label for="website">Ne pas remplir ce champ</label>
                        <input id="website" name="website" type="text" tabindex="-1" autocomplete="off">
                    </div>

                    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                        <p class="text-xs text-gray-700">Les champs marqués d’un <span class="text-red-600">*</span> sont obligatoires.</p>
                        <button type="submit" class="btn btn-black px-8 py-3">Envoyer le message</button>
                    </div>

                    <p class="border-t-2 border-black pt-4 text-xs leading-relaxed text-gray-700">
                        Vos nom, adresse e-mail et message sont utilisés uniquement pour répondre à votre demande. Ils me
                        sont transmis par e-mail, ne sont pas enregistrés sur ce site et ne sont jamais revendus ni cédés.
                        Vous pouvez exercer vos droits (accès, rectification, suppression…) à tout moment :
                        <a href="{{ route('privacy') }}#contact-form-data" class="underline underline-offset-2">politique de confidentialité</a>.
                    </p>
                </form>
            </div>
        </div>
    </section>

    <x-marquee text="Imagine • Build • Create • Learn" duration="30s" class="bg-black text-white" />
@endsection
