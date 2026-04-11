@extends('layout.default')

@section('title', __('privacy.seo.title'))
@section('meta_description', __('privacy.seo.meta_description'))

@section('og_title', __('privacy.seo.og_title'))
@section('og_description', __('privacy.seo.og_description'))
@section('og_image', asset(__('privacy.seo.og_image')))

@section('body')

    <section class="border-b-2 border-black">
        <div class="grid">

            <!-- FULL WIDTH -->
            <div class="p-10 md:p-16 flex flex-col justify-center
        bg-yellow-400">

                <nav class="font-sans text-xs md:text-sm mb-6">
                    <a href="{{ url('/' . app()->getLocale()) }}" class="hover:underline">
                        {{ __('common.home') }}
                    </a>

                    <span class="mx-2">/</span>

                    <span class="text-black font-medium">
        {{ __('privacy.hero.title') }}
    </span>
                </nav>

                <h1 class="font-display text-5xl md:text-7xl font-black tracking-tight leading-none">
                    {{ __('privacy.hero.title') }}
                </h1>

                <p class="mt-6 font-sans text-sm md:text-base font-medium max-w-2xl">
                    {{ __('privacy.hero.subtitle') }}
                </p>

            </div>

        </div>
    </section>

    <!-- CONTENT -->
    <section class="border-b-2 border-black bg-white">
        <div class="p-8 md:p-16 max-w-4xl">

            <h2 class="font-display text-3xl md:text-5xl font-bold tracking-tight border-b-4 border-black pb-2 inline-block">
                {{ __('privacy.section.intro.title') }}
            </h2>

            <p class="mt-6 font-sans text-base md:text-lg">
                {{ __('privacy.section.intro.text') }}
            </p>

            <h2 class="mt-12 font-display text-3xl md:text-4xl font-bold tracking-tight">
                {{ __('privacy.section.data.title') }}
            </h2>

            <p class="mt-4 font-sans text-base md:text-lg">
                {{ __('privacy.section.data.text') }}
            </p>

            <h2 class="mt-12 font-display text-3xl md:text-4xl font-bold tracking-tight">
                {{ __('privacy.section.cookies.title') }}
            </h2>

            <p class="mt-4 font-sans text-base md:text-lg">
                {{ __('privacy.section.cookies.text') }}
            </p>

            <h2 class="mt-12 font-display text-3xl md:text-4xl font-bold tracking-tight">
                {{ __('privacy.section.contact.title') }}
            </h2>

            <p class="mt-4 font-sans text-base md:text-lg">
                {{ __('privacy.section.contact.text') }}
            </p>

            <div class="mt-10">
                <a href="mailto:arthur.cottey1@gmail.com"
                   class="inline-block border-2 border-black px-6 py-3 font-sans text-sm font-medium hover:bg-black hover:text-white">
                    {{ __('privacy.contact_button') }}
                </a>
            </div>

        </div>
    </section>
    <section class="border-b-2 border-black overflow-hidden bg-black text-white">
        <div class="marquee">
            <div class="marquee-content marqueeEnd flex items-center gap-12 py-4">
                @for($i = 0; $i < 6; $i++)
                    <span class="font-display text-xl font-bold whitespace-nowrap">
                        Imagine • Build • Create • Learn
                    </span>
                @endfor
            </div>
        </div>
    </section>
@endsection
