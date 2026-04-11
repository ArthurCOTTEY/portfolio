<header class="scroll-mt-24 sticky top-0 z-50 bg-white border-b-2 border-black">
    <div class="flex items-center justify-between p-4">
        <div class="font-display font-bold text-lg tracking-tight">
            <a href="{{ url('/' . app()->getLocale()) }}">
                ARTHUR COTTEY
            </a>
        </div>

        <nav class="hidden md:flex items-center gap-8 font-sans text-sm">
            <a href="#about">{{__('home.about')}}</a>
            <a href="#skills">{{__('home.skills')}}</a>
            <a href="#experience">{{__('home.experience')}}</a><a href="#contact"
                                                 class="border-2 border-black px-5 py-2 font-sans text-sm font-medium
          bg-yellow-400 hover:-translate-y-0.5 hover:bg-black hover:text-white transition">
                {{__('home.contact')}}
            </a>
        </nav>

        <button
            id="menu-btn"
            type="button"
            class="md:hidden flex flex-col justify-center items-center w-10 h-10 border-2 border-black"
            aria-expanded="false"
            aria-controls="mobile-menu"
            aria-label="Menu burger"
        >
            <span class="block w-5 h-0.5 bg-black mb-1 transition-all"></span>
            <span class="block w-5 h-0.5 bg-black mb-1 transition-all"></span>
            <span class="block w-5 h-0.5 bg-black transition-all"></span>
        </button>

    </div>

    <div
        id="mobile-menu"
        class="md:hidden fixed top-[72px] inset-x-0 bg-white border-t-2 border-black
           transform -translate-y-5 opacity-0 pointer-events-none
           transition-all duration-300 ease-in-out"
    >
        <nav class="flex flex-col font-sans text-base">
            <a href="#about" class="p-4 border-b border-black hover:bg-gray-100">{{__('home.about')}}</a>
            <a href="#skills" class="p-4 border-b border-black hover:bg-gray-100">{{__('home.skills')}}</a>
            <a href="#experience" class="p-4 border-b border-black hover:bg-gray-100">{{__('home.experience')}}</a>
            <a href="#contact"
               class="p-4 bg-yellow-400 text-black font-medium hover:bg-black hover:text-white transition">
                {{__('home.contact')}}
            </a>
        </nav>
    </div>
</header>
