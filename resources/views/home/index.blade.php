@extends('layout.default')

@section('title', __('home.seo.title'))
@section('meta_description', __('home.seo.meta_description'))

@section('og_title', __('home.seo.og_title'))
@section('og_description', __('home.seo.og_description'))
@section('og_image', asset(__('home.seo.og_image')))

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
                    {{ __('home.hero.job') }}
                </p>
                <p class="mt-2 font-sans text-sm">
                    {{ __('home.hero.location') }}
                </p>
                <p class="mt-6 font-sans text-sm max-w-md">
                    {{ __('home.hero.description') }}
                </p>
            </div>
            <div class="h-[260px] md:h-full">
                <img
                    src="{{ asset('storage/image_hero.webp') }}"
                    alt="About"
                    loading="eager"
                    width="638"
                    height="456"
                    class="w-full h-full object-cover"
                    fetchpriority="high"
                >
            </div>
        </div>
    </section>
    <section id="about" class="border-b-2 border-black scroll-mt-20">
        <div class="grid md:grid-cols-12">
            <div class="order-2 md:order-1 md:col-span-3
            border-t-2 md:border-t-0 md:border-r-2 border-black
            bg-white h-[260px] md:h-full">
                <img
                    src="{{ asset('storage/image_about.webp') }}"
                    loading="eager"
                    alt="Liverpool"
                    class="w-full h-full object-cover"
                    width="317"
                    height="596"
                    fetchpriority="high"
                >
            </div>
            <div class="order-1 md:order-2 md:col-span-9 p-10 md:p-16 bg-white">
                <h2 class="font-display text-4xl md:text-6xl font-bold tracking-tight inline-block border-b-4 border-yellow-400 pb-1">
                    {{ __('home.about_section.title') }}
                </h2>
                <div class="mt-10 max-w-3xl">
                    <p class="font-sans text-base md:text-lg">
                        {{ __('home.about_section.p1') }}
                    </p>
                    <p class="mt-6 font-sans text-base md:text-lg">
                        {{ __('home.about_section.p2') }}
                    </p>
                    <p class="mt-6 font-sans text-base md:text-lg">
                        {{ __('home.about_section.p3') }}
                    </p>
                </div>
                <div class="mt-10">
                    <a
                        href="https://www.linkedin.com/in/arthur-cottey-456a4236b/"
                        target="_blank"
                        class="inline-block border-2 border-black px-6 py-3 font-sans text-sm font-medium hover:bg-black hover:text-white"
                    >
                        {{ __('home.about_section.linkedin') }}
                    </a>
                </div>
            </div>
        </div>
    </section>
    <section class="border-b-2 border-black overflow-hidden bg-green-500 text-white">
        <div class="marquee flex whitespace-nowrap">
            <div class="marquee-content flex items-center gap-12 py-4">
                @for($i = 0; $i < 6; $i++)
                    <a
                        href="https://www.linkedin.com/in/arthur-cottey-456a4236b/"
                        target="_blank"
                        class="flex items-center gap-2 font-display text-xl font-bold underline-offset-4 hover:underline"
                    >
                        {{__('home.about_section.linkedin')}}
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
                    {{ __('home.skills_section.title') }}
                </h2>

                <p class="mt-4 font-sans text-sm md:text-base leading-relaxed">
                    {{ __('home.skills_section.description') }}
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
                                <div class="group relative bg-white h-13 w-13 flex items-center justify-center [&>svg]:max-w-[30px] [&>svg]:max-h-[30px]">
                                    {!! file_get_contents(storage_path('app/public/' . $skill->image)) !!}
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
                {{ __('home.quote_section.title') }}
            </p>

            <p class="mt-4 font-sans text-sm md:text-base">
                {{ __('home.quote_section.subtitle') }}
            </p>

        </div>
    </section>

    <section id="experience" class="border-b-2 border-black scroll-mt-20 bg-white">

        <div class="p-8 md:p-12 lg:p-16">

            <!-- Title -->
            <div class="max-w-3xl">
                <h2 class="font-display text-4xl md:text-6xl font-bold tracking-tight inline-block border-b-4 border-blue-500 pb-1">
                    {{ __('home.experience_section.title') }}
                </h2>

                <p class="mt-4 font-sans text-sm md:text-base">
                    {{ __('home.experience_section.intro') }}
                </p>
            </div>

            <!-- Timeline -->
            <div class="mt-10">

                <!-- Item 1 -->
                <div class="border-l-2 border-black pl-6 relative">
                    <span class="absolute left-0 top-[30px] w-4 h-4 bg-green-500 -translate-x-1/2"></span>

                    <p class="font-sans text-xs text-gray-500 pt-3">
                        {{ __('home.experience_section.items.current.date') }}
                    </p>

                    <h3 class="font-display text-xl font-bold">
                        {{ __('home.experience_section.items.current.title') }}
                    </h3>

                    <p class="mt-2 font-sans text-sm text-gray-600">
                        {{ __('home.experience_section.items.current.description') }}
                    </p>
                </div>

                <!-- Item 2 -->
                <div class="border-l-2 border-black pl-6 relative">
                    <span class="absolute left-0 top-[30px] w-4 h-4 bg-blue-500 -translate-x-1/2"></span>

                    <p class="font-sans text-xs text-gray-500 pt-3">
                        {{ __('home.experience_section.items.alternance.date') }}
                    </p>

                    <h3 class="font-display text-xl font-bold">
                        {{ __('home.experience_section.items.alternance.title') }}
                    </h3>

                    <p class="mt-2 font-sans text-sm text-gray-600">
                        {{ __('home.experience_section.items.alternance.description') }}
                    </p>
                </div>

                <!-- Item 3 -->
                <div class="border-l-2 border-black pl-6 relative">
                    <span class="absolute left-0 top-[30px] w-4 h-4 bg-yellow-400 -translate-x-1/2"></span>

                    <p class="font-sans text-xs text-gray-500 pt-3">
                        {{ __('home.experience_section.items.formation.date') }}
                    </p>

                    <h3 class="font-display text-xl font-bold">
                        {{ __('home.experience_section.items.formation.title') }}
                    </h3>

                    <p class="mt-2 font-sans text-sm text-gray-600">
                        {{ __('home.experience_section.items.formation.description') }}
                    </p>
                </div>

            </div>
        </div>

    </section>
    <section id="contact" class="border-b-2 border-black scroll-mt-20 bg-white">

        <div class="grid md:grid-cols-12">

            <!-- LEFT -->
            <div class="md:col-span-4
            border-b-2 md:border-b-0 md:border-r-2 border-black
            p-8 md:p-12 bg-yellow-400 text-black">

                <h2 class="font-display text-3xl md:text-5xl font-bold tracking-tight">
                    {{ __('home.contact_section.title') }}
                </h2>

                <p class="mt-4 font-sans text-sm">
                    {{ __('home.contact_section.intro') }}
                </p>

                <div class="mt-8 space-y-3 font-sans text-sm">
                    <a href="mailto:arthur.cottey1@gmail.com" class="block underline-offset-4 hover:underline">
                        arthur.cottey1@gmail.com
                    </a>

                    <a href="https://www.linkedin.com/in/arthur-cottey-456a4236b/" target="_blank"
                       class="block underline-offset-4 hover:underline">
                        LinkedIn
                    </a>
                </div>

            </div>

            <!-- RIGHT -->
            <div class="md:col-span-8 p-8 md:p-12 bg-white">

                <form method="POST" class="space-y-6" id="contactForm" action="{{ route('contact.store', app()->getLocale()) }}">
                    @csrf

                    <!-- NAME -->
                    <div>
                        <label class="block text-sm font-sans mb-1" for="name">
                            {{ __('home.contact_section.fields.name') }}
                            <span class="text-red-500">{{ __('home.contact_section.required') }}</span>
                        </label>

                        <input type="text" name="name" required id="name"
                               class="w-full border-2 border-black p-3 outline-none focus:bg-gray-100 transition-all duration-200">

                        <p class="text-red-500 text-sm mt-1 hidden opacity-0 transition-all duration-300" id="error-name"></p>
                    </div>

                    <!-- EMAIL -->
                    <div>
                        <label class="block text-sm font-sans mb-1" for="email">
                            {{ __('home.contact_section.fields.email') }}
                            <span class="text-red-500">{{ __('home.contact_section.required') }}</span>
                        </label>

                        <input type="email" required name="email" id="email"
                               class="w-full border-2 border-black p-3 outline-none focus:bg-gray-100 transition-all duration-200">

                        <p class="text-red-500 text-sm mt-1 hidden opacity-0 transition-all duration-300" id="error-email"></p>
                    </div>

                    <!-- MESSAGE -->
                    <div>
                        <label class="block text-sm font-sans mb-1" for="message">
                            {{ __('home.contact_section.fields.message') }}
                            <span class="text-red-500">{{ __('home.contact_section.required') }}</span>
                        </label>

                        <textarea name="message" id="message" required rows="5"
                                  class="w-full border-2 border-black p-3 outline-none focus:bg-gray-100 transition-all duration-200"></textarea>

                        <p class="text-red-500 text-sm mt-1 hidden opacity-0 transition-all duration-300" id="error-message"></p>
                    </div>

                    <!-- SUBMIT -->
                    <button type="submit"
                            class="border-2 border-black px-6 py-3 text-sm font-medium hover:bg-black hover:text-white">
                        {{ __('home.contact_section.submit') }}
                    </button>

                </form>

            </div>
        </div>

    </section>
    <section class="border-b-2 border-black overflow-hidden bg-black text-white">
        <div class="marquee">
            <div class="marquee-content marqueeEnd flex items-center gap-12 py-4">
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
<script>
    window.i18n = @json(__('form'));
</script>
