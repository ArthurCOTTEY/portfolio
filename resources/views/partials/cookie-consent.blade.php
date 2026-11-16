@php
    $gaId = config('site.analytics.enabled') ? config('site.analytics.ga_id') : null;
@endphp
<div id="cookie-consent"
     data-ga-id="{{ $gaId }}"
     data-version="{{ config('site.consent.version') }}"
     data-lifetime-days="{{ config('site.consent.lifetime_days') }}"
     data-cookie-name="{{ config('site.consent.cookie') }}">

    {{-- Bandeau : affiché uniquement tant qu'aucun choix valide n'a été fait. --}}
    <section id="cookie-banner" hidden aria-labelledby="cookie-banner-title"
             class="fixed inset-x-3 bottom-3 z-[60] mx-auto max-w-3xl border-2 border-black bg-white p-4 shadow-[6px_6px_0_0_#000] md:p-6">
        <h2 id="cookie-banner-title" class="font-display text-base font-bold md:text-lg">Vos données, votre choix</h2>
        <p class="mt-2 text-[13px] leading-snug text-gray-800 md:text-sm md:leading-relaxed">
            Avec votre accord, j’utilise <strong>Google Analytics</strong> pour mesurer l’audience de ce site
            (pages consultées, type d’appareil…). Ces cookies sont conservés 13&nbsp;mois maximum et les données
            sont traitées par Google, y compris aux États-Unis. Vous pouvez accepter, refuser ou changer d’avis à tout
            moment via le lien « Gestion des cookies » en bas de page.
            <a href="{{ route('privacy') }}#cookies" class="font-medium underline underline-offset-4">En savoir plus</a>
        </p>
        <div class="mt-3 grid grid-cols-2 gap-3 sm:flex sm:items-center md:mt-4">
            <button type="button" data-consent="refuse" class="btn btn-white sm:min-w-36">Tout refuser</button>
            <button type="button" data-consent="accept" class="btn btn-white sm:min-w-36">Tout accepter</button>
            <button type="button" data-consent="customize" class="col-span-2 text-sm font-medium underline underline-offset-4 sm:ml-auto">
                Personnaliser
            </button>
        </div>
    </section>

    {{-- Préférences détaillées : <dialog> natif (focus piégé, Échap pour fermer). --}}
    <dialog id="cookie-preferences" aria-labelledby="cookie-preferences-title"
            class="m-auto w-[calc(100%-2rem)] max-w-2xl border-2 border-black bg-white p-0 text-black shadow-[8px_8px_0_0_#000] backdrop:bg-black/50">
        <div class="flex items-center justify-between gap-4 border-b-2 border-black p-5 md:p-6">
            <h2 id="cookie-preferences-title" class="font-display text-2xl font-bold tracking-tight">Gestion des cookies</h2>
            <button type="button" data-consent="close" class="flex h-10 w-10 items-center justify-center border-2 border-black hover:bg-black hover:text-white" aria-label="Fermer sans enregistrer">✕</button>
        </div>

        <div class="max-h-[60vh] space-y-5 overflow-y-auto p-5 text-sm leading-relaxed md:p-6">
            <p>
                Choisissez les cookies que vous acceptez. Votre choix est conservé 6&nbsp;mois et peut être modifié
                à tout moment. Refuser n’a aucune conséquence sur votre navigation.
                <a href="{{ route('privacy') }}#cookies" class="font-medium underline underline-offset-4">Politique de confidentialité</a>
            </p>

            <div class="border-2 border-black">
                <div class="flex items-start justify-between gap-4 bg-gray-100 p-4">
                    <div>
                        <h3 class="font-display text-base font-bold">Strictement nécessaires</h3>
                        <p class="mt-1 text-gray-800">
                            Session, protection du formulaire contre les attaques (CSRF) et mémorisation de votre choix.
                            Exemptés de consentement, ils ne servent à aucun suivi.
                        </p>
                    </div>
                    <span class="shrink-0 border-2 border-black bg-black px-2 py-1 text-xs font-semibold text-white">Toujours actifs</span>
                </div>
            </div>

            <div class="border-2 border-black">
                <div class="flex items-start justify-between gap-4 p-4">
                    <div>
                        <h3 class="font-display text-base font-bold"><label for="consent-analytics">Mesure d’audience</label></h3>
                        <p class="mt-1 text-gray-800">
                            Google Analytics 4 (Google Ireland Ltd / Google LLC) : statistiques de visite anonymes
                            pour comprendre quelles pages sont utiles. Cookies <code>_ga</code> et <code>_ga_*</code>,
                            13&nbsp;mois maximum. Transfert vers les États-Unis encadré par le Data Privacy Framework.
                        </p>
                    </div>
                    <span class="relative inline-flex shrink-0 items-center">
                        <input id="consent-analytics" type="checkbox" role="switch" class="peer absolute inset-0 z-10 cursor-pointer opacity-0">
                        <span aria-hidden="true" class="h-8 w-14 border-2 border-black bg-white transition peer-checked:bg-green-500 peer-focus-visible:outline-3 peer-focus-visible:outline-offset-2 peer-focus-visible:outline-black"></span>
                        <span aria-hidden="true" class="absolute top-1/2 left-1.5 h-4 w-4 -translate-y-1/2 bg-black transition peer-checked:translate-x-6"></span>
                    </span>
                </div>
            </div>
        </div>

        <div class="flex flex-col gap-3 border-t-2 border-black p-5 sm:flex-row sm:justify-end md:p-6">
            <button type="button" data-consent="refuse" class="btn btn-white">Tout refuser</button>
            <button type="button" data-consent="accept" class="btn btn-white">Tout accepter</button>
            <button type="button" data-consent="save" class="btn btn-black">Enregistrer mon choix</button>
        </div>
    </dialog>
</div>
