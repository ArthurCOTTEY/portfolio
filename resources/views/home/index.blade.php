@extends('layout.default')

@section('title', 'Arthur Cottey — Développeur Web Full Stack PHP Laravel à Tours')
@section('meta_description', 'Arthur Cottey, développeur web full stack spécialisé en PHP et Laravel à Tours. Découvrez son parcours, ses compétences et son profil de développeur.')
@section('og_title', 'Arthur Cottey — Développeur Web Full Stack')
@section('og_description', 'Développeur web full stack basé à Tours, spécialisé en PHP, Laravel, Vue.js et Nuxt. Découvrez mon parcours et mes compétences.')
@section('og_image', asset('images/preview.jpg'))

@section('body')
    <section class="border-b-2 border-black">
        <div class="grid md:grid-cols-2">
            <div class="p-10 flex flex-col justify-center
            border-b-2 md:border-b-0 md:border-r-2 border-black
            bg-yellow-400">
                <h1 class="font-display text-6xl md:text-8xl font-black tracking-tight leading-none">
                    ARTHUR<br>
                    COTTEY
                </h1>
                <p class="mt-6 font-sans text-lg font-medium">
                    Développeur web full stack spécialisé en PHP et Laravel
                </p>
                <p class="mt-2 font-sans text-sm">
                    Basé à Tours
                </p>
                <p class="mt-6 font-sans text-sm max-w-md">
                    Je conçois et développe des applications web performantes, du site vitrine au CRM en passant par des plateformes e-commerce, avec une attention particulière portée à la qualité du code, à la structure des projets et à l’expérience utilisateur.
                </p>
            </div>
            <div class="h-full">
                <img
                    src="{{ asset('storage/image_hero.webp') }}"
                    alt=""
                    class="w-full h-full object-cover"
                >
            </div>
        </div>
    </section>
    <section id="about" class="border-b-2 border-black scroll-mt-20">
        <div class="grid md:grid-cols-12">
            <div class="order-2 md:order-1 md:col-span-3
            border-t-2 md:border-t-0 md:border-r-2 border-black
            bg-white">
                <img
                    src="{{ asset('storage/image_about.webp') }}"
                    alt=""
                    class="w-full h-full object-cover"
                >
            </div>
            <div class="order-1 md:order-2 md:col-span-9 p-10 md:p-16 bg-white">
                <h2 class="font-display text-4xl md:text-6xl font-bold tracking-tight inline-block border-b-4 border-yellow-400 pb-1">
                    À PROPOS
                </h2>
                <div class="mt-10 max-w-3xl">
                    <p class="font-sans text-base md:text-lg">
                        Je suis <span class="font-bold">Arthur Cottey</span>, développeur web full stack basé à Tours, spécialisé en PHP et Laravel. Je conçois des applications web performantes avec une attention particulière portée à la qualité du code et à l’expérience utilisateur.
                    </p>
                    <p class="mt-6 font-sans text-base md:text-lg">
                        J’interviens sur des projets variés, du site vitrine à des applications plus complexes comme des CRM ou des plateformes e-commerce, avec une approche structurée et efficace.
                    </p>
                    <p class="mt-6 font-sans text-base md:text-lg">
                        En dehors du développement, je pratique le football en club, un environnement qui m’apporte rigueur et esprit d’équipe. Je suis également un grand supporter du Liverpool FC et j’aime voyager pour découvrir de nouvelles cultures, ce qui nourrit ma curiosité et ma façon d’aborder les projets.
                    </p>
                </div>
                <div class="mt-10">
                    <a
                        href="https://www.linkedin.com/in/arthur-cottey-456a4236b/"
                        target="_blank"
                        class="inline-block border-2 border-black px-6 py-3 font-sans text-sm font-medium hover:bg-black hover:text-white"
                    >
                        Voir mon LinkedIn
                    </a>
                </div>
            </div>
        </div>
    </section>
    <section class="border-b-2 border-black overflow-hidden bg-green-500 text-white">
        <div class="marquee flex whitespace-nowrap">
            <div class="marquee-content flex items-center gap-12 py-4">
                @for($i = 0; $i < 15; $i++)
                    <a
                        href="https://www.linkedin.com/in/arthur-cottey-456a4236b/"
                        target="_blank"
                        class="flex items-center gap-2 font-display text-xl font-bold underline-offset-4 hover:underline"
                    >
                        Voir mon LinkedIn
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="20"
                            height="20"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        >
                            <path d="M7 7h10v10"/>
                            <path d="M7 17 17 7"/>
                        </svg>
                    </a>
                @endfor
            </div>
        </div>
    </section>
    <section id="skills" class="border-b-2 border-black scroll-mt-20 bg-white">
        <div class="p-8 md:p-12 lg:p-16">
            <div class="max-w-3xl">
                <h2 class="font-display text-4xl md:text-6xl font-bold tracking-tight inline-block border-b-4 border-green-500 pb-1">
                    CE QUE JE MAÎTRISE
                </h2>
                <p class="mt-4 font-sans text-sm md:text-base leading-relaxed">
                    J’utilise au quotidien différents langages, frameworks et outils tels que PHP, Laravel, Vue.js et Nuxt pour concevoir des applications web performantes, maintenables et adaptées aux besoins des projets.
                </p>
            </div>
            <div class="mt-10 grid md:grid-cols-3 gap-6">
                @foreach($languages as $language)
                    <div class="bg-gray-100 p-6">
                        <h3 class="font-display text-xl font-bold tracking-tight">
                            {{ $language->name }}
                        </h3>
                        <p class="mt-2 font-sans text-sm text-gray-600">
                            {{ $language->description }}
                        </p>
                        <div class="mt-6 flex flex-wrap gap-3">
                            @foreach($language->skills as $skill)
                                <div class="group relative bg-white h-13 w-13 flex items-center justify-center">
                                    <img
                                        src="{{ asset('storage/' . $skill->image) }}"
                                        width="30"
                                        height="30"
                                        loading="lazy"
                                        alt="{{ $skill->name }}"
                                    >
                                    <span class="absolute -top-6 left-1/2 -translate-x-1/2 bg-black text-white text-[10px] px-2 py-0.5 opacity-0 group-hover:opacity-100 transition whitespace-nowrap">
                                        {{ $skill->name }}
                                    </span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <section class="border-b-2 border-black bg-blue-500 text-white">
        <div class="p-10 md:p-14 text-center">
            <p class="font-display text-2xl md:text-4xl font-bold tracking-tight">
                J’aime concevoir des expériences web simples, efficaces et impactantes.
            </p>
            <p class="mt-4 font-sans text-sm md:text-base">
                Toujours en quête de nouveaux défis techniques et d’opportunités pour apprendre et progresser.
            </p>
        </div>
    </section>
    <section id="experience" class="border-b-2 border-black scroll-mt-20 bg-white">
        <div class="p-8 md:p-12 lg:p-16">
            <div class="max-w-3xl">
                <h2 class="font-display text-4xl md:text-6xl font-bold tracking-tight inline-block border-b-4 border-blue-500 pb-1">
                    PARCOURS
                </h2>
                <p class="mt-4 font-sans text-sm md:text-base">
                    Mon parcours dans le développement web, de ma formation en BTS SIO option SLAM à mon poste actuel en agence web.
                </p>
            </div>
            <div class="mt-10">
                <div class="border-l-2 border-black pl-6 relative">
                    <span class="absolute left-0 top-[30px] w-4 h-4 bg-green-500 -translate-x-1/2"></span>
                    <p class="font-sans text-xs text-gray-500 pt-3">Aujourd’hui</p>
                    <h3 class="font-display text-xl font-bold">
                        Développeur Full Stack — CDI
                    </h3>
                    <p class="mt-2 font-sans text-sm text-gray-600">
                        Développement d’applications web sur mesure avec un framework PHP interne, participation à la maintenance et à l’évolution de projets existants, ainsi qu’à la conception de nouvelles fonctionnalités.
                    </p>
                </div>
                <div class="border-l-2 border-black pl-6 relative">
                    <span class="absolute left-0 top-[30px] w-4 h-4 bg-blue-500 -translate-x-1/2"></span>
                    <p class="font-sans text-xs text-gray-500 pt-3">Alternance</p>
                    <h3 class="font-display text-xl font-bold">
                        BTS SIO — Option SLAM
                    </h3>
                    <p class="mt-2 font-sans text-sm text-gray-600">
                        Formation en développement d’applications web (option SLAM) réalisée en alternance, avec une expérience concrète en entreprise sur des projets réels.
                    </p>
                </div>
                <div class="border-l-2 border-black pl-6 relative">
                    <span class="absolute left-0 top-[30px] w-4 h-4 bg-yellow-400 -translate-x-1/2"></span>
                    <p class="font-sans text-xs text-gray-500 pt-3">Formation</p>
                    <h3 class="font-display text-xl font-bold">
                        Bac Pro SN
                    </h3>
                    <p class="mt-2 font-sans text-sm text-gray-600">
                        Acquisition des bases en systèmes numériques et premières compétences techniques en informatique et développement.
                    </p>
                </div>
            </div>
        </div>
    </section>
    <section id="contact" class="border-b-2 border-black scroll-mt-20 bg-white">
        <div class="grid md:grid-cols-12">
            <div class="md:col-span-4
            border-b-2 md:border-b-0 md:border-r-2 border-black
            p-8 md:p-12 bg-yellow-400 text-black">
                <h2 class="font-display text-3xl md:text-5xl font-bold tracking-tight">
                    CONTACT
                </h2>
                <p class="mt-4 font-sans text-sm">
                    Une opportunité, un échange ou simplement l’envie de discuter autour du développement web ? N’hésitez pas à me contacter.
                </p>
                <div class="mt-8 space-y-3 font-sans text-sm">
                    <a href="mailto:arthur.cottey1@gmail.com" class="block underline-offset-4 hover:underline">
                        arthur.cottey1@gmail.com
                    </a>
                    <a href="https://www.linkedin.com/in/arthur-cottey-456a4236b/" target="_blank" class="block underline-offset-4 hover:underline">
                        LinkedIn
                    </a>
                </div>
            </div>
            <div class="md:col-span-8 p-8 md:p-12 bg-white">
                <form id="contactForm" method="POST" action="/contact" class="space-y-6">
                    @csrf
                    <div>
                        <label class="block text-sm font-sans mb-1" for="name">
                            Nom <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="name" required id="name"
                               class="w-full border-2 border-black p-3 outline-none focus:bg-gray-100 transition-all duration-200">
                        <p class="text-red-500 text-sm mt-1 hidden opacity-0 transition-all duration-300" id="error-name"></p>
                    </div>

                    <div>
                        <label class="block text-sm font-sans mb-1" for="name">
                            Nom <span class="text-red-500">*</span>
                        </label>
                        <input type="email" required name="email" id="email"
                               class="w-full border-2 border-black p-3 outline-none focus:bg-gray-100 transition-all duration-200">
                        <p class="text-red-500 text-sm mt-1 hidden opacity-0 transition-all duration-300" id="error-email"></p>
                    </div>

                    <div>
                        <label class="block text-sm font-sans mb-1" for="message">
                            Message <span class="text-red-500">*</span>
                        </label>
                        <textarea name="message" id="message" required rows="5"
                                  class="w-full border-2 border-black p-3 outline-none focus:bg-gray-100 transition-all duration-200"></textarea>
                        <p class="text-red-500 text-sm mt-1 hidden opacity-0 transition-all duration-300" id="error-message"></p>
                    </div>
                    <button type="submit" class="border-2 border-black px-6 py-3 text-sm font-medium hover:bg-black hover:text-white">
                        Envoyer
                    </button>
                </form>
            </div>
        </div>
    </section>
    <section class="border-b-2 border-black overflow-hidden bg-black text-white">
        <div class="marquee">
            <div class="marquee-content flex items-center gap-12 py-4">
                @for($i = 0; $i < 15; $i++)
                    <span class="font-display text-xl font-bold whitespace-nowrap">
                        Imagine • Build • Create • Learn
                    </span>
                @endfor
            </div>
        </div>
    </section>
    <div id="toast" class="fixed bottom-5 left-1/2 -translate-x-1/2 hidden z-50">
        <div id="toastContent"
             class="px-6 py-4 rounded shadow-lg text-white font-medium transform transition-all duration-300 translate-y-full opacity-0">
            Message ici
        </div>
    </div>
@endsection
