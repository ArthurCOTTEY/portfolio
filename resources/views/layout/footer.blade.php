<footer class="border-t-2 border-black bg-white">

    <div class="flex flex-col md:flex-row items-center justify-between gap-6 p-6 md:p-8">
        <div class="text-sm font-sans text-gray-600 text-center md:text-left">
            © {{ date('Y') }} Arthur Cottey — {{ __('home.footer.copyright') }} —
            <a href="{{ url('/' . app()->getLocale() . '/' . __('common.privacy_slug')) }}"
               class="hover:underline">
                {{ __('privacy.hero.title') }}
            </a>
        </div>

        <!-- RIGHT -->
        <div class="flex items-center gap-3">

            <!-- BACK TO TOP -->
            <a href="#top"
               class="w-10 h-10 border-2 border-black flex items-center justify-center hover:bg-black hover:text-white">

                ↑

            </a>

            <!-- LINKEDIN -->
            <a href="https://www.linkedin.com/in/arthur-cottey-456a4236b/" target="_blank"
               class="w-10 h-10 border-2 border-black flex items-center justify-center hover:bg-black hover:text-white">

                in

            </a>

            <!-- MAIL -->
            <a href="mailto:arthur.cottey1@gmail.com"
               class="w-10 h-10 border-2 border-black flex items-center justify-center hover:bg-black hover:text-white">

                @

            </a>

            <a href="{{ url('/fr') }}"
               class="w-10 h-10 border-2 border-black flex items-center justify-center text-xs font-sans
       transition hover:bg-black hover:text-white
       {{ app()->getLocale() === 'fr' ? 'bg-black text-white' : '' }}">
                FR
            </a>

            <a href="{{ url('/en') }}"
               class="w-10 h-10 border-2 border-black flex items-center justify-center text-xs font-sans
       transition hover:bg-black hover:text-white
       {{ app()->getLocale() === 'en' ? 'bg-black text-white' : '' }}">
                EN
            </a>

            <a href="#"
               aria-label="cookie"
               id="openCookieModalLink"
               class="w-10 h-10 border-2 border-black flex items-center justify-center hover:bg-black hover:text-white">

                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-cookie-icon lucide-cookie"><path d="M12 2a10 10 0 1 0 10 10 4 4 0 0 1-5-5 4 4 0 0 1-5-5"/><path d="M8.5 8.5v.01"/><path d="M16 15.5v.01"/><path d="M12 12v.01"/><path d="M11 17v.01"/><path d="M7 14v.01"/></svg>

            </a>



        </div>

    </div>

</footer>
