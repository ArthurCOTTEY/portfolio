<header class="sticky top-0 z-50 border-b-2 border-black bg-white">
    <div class="flex items-center justify-between gap-4 p-4">
        <a href="{{ route('home') }}" class="font-display text-lg font-bold tracking-tight uppercase" aria-label="Arthur Cottey — accueil">
            Arthur Cottey
        </a>

        <nav aria-label="Navigation principale" class="hidden items-center gap-8 text-sm md:flex">
            @include('partials.nav-links', [
                'linkClass' => 'underline-offset-4 hover:underline',
                'ctaClass' => 'btn btn-yellow',
            ])
        </nav>

        <button id="menu-button" type="button" aria-expanded="false" aria-controls="mobile-menu" aria-label="Ouvrir le menu"
                class="group flex h-11 w-11 flex-col items-center justify-center gap-1.5 border-2 border-black md:hidden">
            <span class="block h-0.5 w-5 bg-black transition group-aria-expanded:translate-y-2 group-aria-expanded:rotate-45"></span>
            <span class="block h-0.5 w-5 bg-black transition group-aria-expanded:opacity-0"></span>
            <span class="block h-0.5 w-5 bg-black transition group-aria-expanded:-translate-y-2 group-aria-expanded:-rotate-45"></span>
        </button>
    </div>

    <nav id="mobile-menu" aria-label="Navigation mobile" hidden
         class="absolute inset-x-0 top-full flex flex-col border-b-2 border-black bg-white text-base md:hidden">
        @include('partials.nav-links', [
            'linkClass' => 'border-t border-black p-4 hover:bg-gray-100',
            'ctaClass' => 'border-t-2 border-black bg-yellow-400 p-4 font-semibold hover:bg-black hover:text-white',
        ])
    </nav>
</header>
