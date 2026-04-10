<div class="fixed bottom-0 left-1/2 -translate-x-1/2 w-full max-w-7xl border-l-2 border-r-2 border-black">
    <div id="cookieBanner" class="bg-white border-t-2 border-black p-6 z-50">

        <div class="max-w-6xl mx-auto flex flex-col md:flex-row md:items-center md:justify-between gap-6">

            <p class="font-sans text-sm max-w-2xl">
                {{ __('home.cookies.text') }}
            </p>

            <div class="flex gap-4">

                <button id="acceptCookies"
                        class="border-2 border-black px-5 py-2 text-sm font-medium bg-green-500 text-white hover:bg-black">
                    {{ __('home.cookies.accept') }}
                </button>

                <button id="refuseCookies"
                        class="border-2 border-black px-5 py-2 text-sm font-medium hover:bg-black hover:text-white">
                    {{ __('home.cookies.refuse') }}
                </button>

                <button id="manageCookies"
                        class="border-2 border-black px-5 py-2 text-sm font-medium bg-yellow-400 hover:bg-black hover:text-white">
                    {{ __('home.cookies.manage') }}
                </button>

            </div>
        </div>

    </div>
</div>
<div id="cookieWrapper" class="fixed bottom-0 left-1/2 -translate-x-1/2 w-full max-w-7xl border-l-2 border-r-2 border-black z-50 hidden">
    <div id="cookieBanner" class="bg-white border-t-2 border-black p-6">
        <div class="max-w-6xl mx-auto flex flex-col md:flex-row md:items-center md:justify-between gap-6">
            <p class="font-sans text-sm max-w-2xl">
                Ce site utilise des cookies pour améliorer l’expérience utilisateur.
            </p>
            <div class="flex gap-4 flex-wrap">
                <button id="manageCookies" type="button" class="border-2 border-black px-5 py-2 text-sm font-medium bg-yellow-400 hover:bg-black hover:text-white transition">
                    Gérer
                </button>
                <button id="refuseCookies" type="button" class="border-2 border-black px-5 py-2 text-sm font-medium hover:bg-black hover:text-white transition">
                    Refuser
                </button>
                <button id="acceptCookies" type="button" class="border-2 border-black px-5 py-2 text-sm font-medium bg-green-500 text-white hover:bg-black transition">
                    Accepter
                </button>
            </div>
        </div>
    </div>
</div>
<div id="cookieModal"
      class="fixed inset-0 bg-black/40 z-[60] hidden items-center justify-center p-4"
      role="dialog"
      aria-modal="true"
      aria-labelledby="cookieModalTitle">

    <div class="w-full max-w-2xl bg-white border-2 border-black shadow-xl">

        <!-- HEADER -->
        <div class="flex items-center justify-between border-b-2 border-black p-6">

            <h2 id="cookieModalTitle" class="font-display text-2xl md:text-3xl font-bold tracking-tight">
                {{ __('home.cookie_modal.title') }}
            </h2>

            <button id="closeCookieModal"
                    type="button"
                    aria-label="{{ __('home.cookie_modal.close') }}"
                    class="border-2 border-black px-3 py-1 text-sm font-medium hover:bg-black hover:text-white transition">
                ✕
            </button>

        </div>

        <!-- CONTENT -->
        <div class="p-6 space-y-6">

            <p class="font-sans text-sm leading-relaxed">
                {{ __('home.cookie_modal.description') }}

                <a href="/politique-de-confidentialite" class="underline font-medium">
                    {{ __('home.cookie_modal.learn_more') }}
                </a>.
            </p>

            <!-- NECESSARY -->
            <div class="border-2 border-black">

                <div class="border-b-2 border-black p-4 bg-gray-100">

                    <div class="flex items-start justify-between gap-4">

                        <div>
                            <h3 class="font-display text-lg font-bold">
                                {{ __('home.cookie_modal.necessary_title') }}
                            </h3>

                            <p class="mt-1 font-sans text-sm text-gray-700">
                                {{ __('home.cookie_modal.necessary_desc') }}
                            </p>
                        </div>

                        <span class="border-2 border-black px-3 py-1 text-xs font-medium bg-black text-white whitespace-nowrap">
                            {{ __('home.cookie_modal.always_active') }}
                        </span>

                    </div>
                </div>
            </div>

            <!-- ANALYTICS -->
            <div class="border-2 border-black p-4">

                <div class="flex items-start justify-between gap-4">

                    <div>
                        <h3 class="font-display text-lg font-bold">
                            {{ __('home.cookie_modal.analytics_title') }}
                        </h3>

                        <p class="mt-1 font-sans text-sm text-gray-700">
                            {{ __('home.cookie_modal.analytics_desc') }}
                        </p>
                    </div>

                    <label class="inline-flex items-center cursor-pointer select-none group">
                        <input id="analyticsCookies" type="checkbox" class="sr-only peer">

                        <div class="relative w-14 h-8 border-2 border-black bg-white transition-colors duration-200 peer-checked:bg-green-500">
                            <span class="absolute top-1/2 left-1 block w-4 h-4 bg-black transition-all duration-200 ease-out -translate-y-1/2 group-has-[input:checked]:translate-x-6 group-has-[input:checked]:bg-white"></span>
                        </div>
                    </label>

                </div>
            </div>
        </div>

        <!-- FOOTER -->
        <div class="border-t-2 border-black p-6 flex flex-wrap gap-4 justify-end">

            <button id="rejectAllCookies" type="button"
                    class="border-2 border-black px-5 py-2 text-sm font-medium hover:bg-black hover:text-white transition">
                {{ __('home.cookie_modal.reject_all') }}
            </button>

            <button id="saveCookiePreferences" type="button"
                    class="border-2 border-black px-5 py-2 text-sm font-medium bg-yellow-400 hover:bg-black hover:text-white transition">
                {{ __('home.cookie_modal.save') }}
            </button>

            <button id="acceptAllCookies" type="button"
                    class="border-2 border-black px-5 py-2 text-sm font-medium bg-green-500 text-white hover:bg-black transition">
                {{ __('home.cookie_modal.accept_all') }}
            </button>

        </div>

    </div>
</div>
