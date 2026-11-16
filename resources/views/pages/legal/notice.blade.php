@extends('layouts.app')

@section('title', 'Mentions légales — Arthur Cottey')
@section('description', 'Mentions légales du site arthurcottey.fr : éditeur, directeur de la publication, hébergeur et propriété intellectuelle.')

@section('content')
    <x-legal-page title="Mentions légales" intro="Informations légales relatives au site arthurcottey.fr, conformément à l’article 6 de la loi n° 2004-575 du 21 juin 2004 pour la confiance dans l’économie numérique (LCEN).">
        <h2>Éditeur du site</h2>
        <p>
            Le site <strong>arthurcottey.fr</strong> est édité à titre personnel par <strong>Arthur Cottey</strong>,
            développeur web, domicilié à Tours (France).<br>
            Contact : <a href="mailto:{{ config('site.email') }}">{{ config('site.email') }}</a>
        </p>

        <h2>Directeur de la publication</h2>
        <p>Arthur Cottey.</p>

        <h2>Hébergeur</h2>
        @php($host = config('site.host'))
        <p>
            @if ($host['name'])
                <strong>{{ $host['name'] }}</strong>
                @if ($host['address'])<br>{{ $host['address'] }}@endif
                @if ($host['phone'])<br>Téléphone : {{ $host['phone'] }}@endif
                @if ($host['url'])<br><a href="{{ $host['url'] }}" rel="noopener noreferrer" target="_blank">{{ parse_url($host['url'], PHP_URL_HOST) }}</a>@endif
            @else
                Les coordonnées de l’hébergeur sont disponibles sur simple demande à
                <a href="mailto:{{ config('site.email') }}">{{ config('site.email') }}</a>.
            @endif
        </p>

        <h2>Propriété intellectuelle</h2>
        <p>
            L’ensemble des contenus de ce site (textes, mise en page, code, photographies) est la propriété
            d’Arthur Cottey, sauf mention contraire. Toute reproduction ou réutilisation, totale ou partielle, sans
            autorisation préalable est interdite. Les logos des technologies présentées appartiennent à leurs
            détenteurs respectifs et ne sont utilisés qu’à des fins d’illustration.
        </p>

        <h2>Données personnelles</h2>
        <p>
            Le traitement de vos données personnelles est détaillé dans la
            <a href="{{ route('privacy') }}">politique de confidentialité</a>.
        </p>

        <h2>Responsabilité</h2>
        <p>
            Les informations présentées sur ce site sont fournies à titre indicatif et peuvent évoluer. Malgré le soin
            apporté à leur rédaction, l’éditeur ne saurait être tenu responsable d’erreurs ou d’omissions, ni du contenu
            des sites externes vers lesquels des liens peuvent renvoyer.
        </p>

        <h2>Droit applicable</h2>
        <p>Le présent site et ses mentions légales sont soumis au droit français.</p>
    </x-legal-page>
@endsection
