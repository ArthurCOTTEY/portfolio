<footer class="border-t-2 border-black bg-white">
    <div class="grid gap-8 p-8 md:grid-cols-3 md:p-12">
        <div>
            <p class="font-display text-xl font-bold uppercase">Arthur Cottey</p>
            <p class="mt-2 text-sm text-gray-700">{{ config('site.tagline') }}.</p>
        </div>

        <nav aria-label="Contact et réseaux">
            <p class="eyebrow">Me retrouver</p>
            <ul class="mt-3 space-y-2 text-sm">
                <li><a href="mailto:{{ config('site.email') }}" class="underline-offset-4 hover:underline">{{ config('site.email') }}</a></li>
                <li><a href="{{ config('site.linkedin') }}" target="_blank" rel="me noopener noreferrer" class="underline-offset-4 hover:underline">LinkedIn <span class="sr-only">(nouvel onglet)</span>↗</a></li>
            </ul>
        </nav>

        <nav aria-label="Informations légales">
            <p class="eyebrow">Informations</p>
            <ul class="mt-3 space-y-2 text-sm">
                <li><a href="{{ route('legal-notice') }}" class="underline-offset-4 hover:underline">Mentions légales</a></li>
                <li><a href="{{ route('privacy') }}" class="underline-offset-4 hover:underline">Politique de confidentialité</a></li>
                <li><a href="{{ route('privacy') }}#cookies" data-open-cookie-preferences class="underline-offset-4 hover:underline">Gestion des cookies</a></li>
            </ul>
        </nav>
    </div>

    <div class="flex items-center justify-between gap-4 border-t-2 border-black px-8 py-4 text-xs text-gray-700 md:px-12">
        <p>© {{ date('Y') }} Arthur Cottey. Tous droits réservés.</p>
        <a href="#contenu" class="flex h-9 w-9 items-center justify-center border-2 border-black text-black hover:bg-black hover:text-white" aria-label="Revenir en haut de la page">↑</a>
    </div>
</footer>
