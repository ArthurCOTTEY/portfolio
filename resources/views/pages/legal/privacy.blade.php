@extends('layouts.app')

@section('title', 'Politique de confidentialité — Arthur Cottey')
@section('description', 'Données collectées sur arthurcottey.fr, finalités, durées de conservation, mesure d’audience anonyme sans cookie (Matomo) et exercice de vos droits RGPD.')

@section('content')
    <x-legal-page title="Politique de confidentialité" intro="Ce site collecte le minimum de données possible. Cette page explique lesquelles, pourquoi, combien de temps elles sont conservées et comment exercer vos droits, conformément au RGPD et à la loi Informatique et Libertés.">
        <h2 id="responsable">1. Responsable du traitement</h2>
        <p>
            Le responsable des traitements décrits ci-dessous est <strong>Arthur Cottey</strong>, éditeur du site
            (voir les <a href="{{ route('legal-notice') }}">mentions légales</a>). Pour toute question relative à vos
            données : <a href="mailto:{{ config('site.email') }}">{{ config('site.email') }}</a>.
        </p>

        <h2 id="contact-form-data">2. Formulaire de contact</h2>
        <ul>
            <li><strong>Données collectées :</strong> nom, adresse e-mail et contenu du message.</li>
            <li><strong>Finalité :</strong> répondre à votre demande et, le cas échéant, poursuivre l’échange.</li>
            <li><strong>Base légale :</strong> l’intérêt légitime à répondre aux personnes qui me contactent (article 6.1.f du RGPD), ou les mesures précontractuelles prises à votre demande (article 6.1.b).</li>
            <li><strong>Destinataire :</strong> moi uniquement. Le message m’est transmis par e-mail ; il n’est pas enregistré dans la base de données du site.</li>
            <li><strong>Durée de conservation :</strong> le temps de l’échange, puis au maximum 3 ans après notre dernier contact.</li>
        </ul>
        <p>
            Pour limiter les abus, le nombre d’envois est limité par adresse IP ; cette information technique est
            conservée quelques minutes seulement.
        </p>

        <h2 id="audience">3. Mesure d’audience (Matomo, sans cookie)</h2>
        <p>
            Pour savoir quelles pages sont consultées et améliorer le site, j’utilise <strong>Matomo</strong>,
            un outil de statistiques libre, auto-hébergé sur un serveur situé en France (O2Switch). Aucune donnée
            n’est transmise à Google ni à un autre tiers, et aucune donnée ne quitte l’Union européenne.
        </p>
        <ul>
            <li><strong>Sans cookie :</strong> aucun cookie ni traceur n’est déposé sur votre appareil.</li>
            <li><strong>Anonyme :</strong> adresse IP tronquée, aucun suivi d’un site à l’autre, aucun recoupement avec d’autres données.</li>
            <li><strong>Données mesurées :</strong> pages vues, site de provenance, type d’appareil et de navigateur, pays approximatif.</li>
            <li><strong>Base légale :</strong> l’intérêt légitime à mesurer l’audience du site (article 6.1.f du RGPD). Configurée ainsi, cette mesure est exemptée de consentement selon les recommandations de la CNIL.</li>
            <li><strong>Durée de conservation :</strong> 13&nbsp;mois maximum.</li>
        </ul>
        @if (\App\Support\Analytics::enabled())
            <p>Vous pouvez néanmoins refuser d’être comptabilisé :</p>
            <div id="matomo-opt-out" class="mt-4 border-2 border-black bg-gray-100 p-4 text-sm"></div>
            <script src="{{ \App\Support\Analytics::trackerUrl() }}index.php?module=CoreAdminHome&amp;action=optOutJS&amp;divId=matomo-opt-out&amp;language=fr&amp;showIntro=0" defer></script>
        @endif

        <h2 id="cookies">4. Cookies</h2>
        <p>
            Ce site ne dépose <strong>aucun cookie publicitaire ni de mesure d’audience</strong>. Seuls les cookies
            strictement nécessaires à son fonctionnement sont utilisés ; ils sont exemptés de consentement,
            c’est pourquoi aucun bandeau ne vous est présenté.
        </p>
        <div class="overflow-x-auto">
            <table>
                <thead>
                    <tr>
                        <th scope="col">Cookie</th>
                        <th scope="col">Finalité</th>
                        <th scope="col">Durée</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><code>{{ config('session.cookie') }}</code></td>
                        <td>Session technique nécessaire au fonctionnement du site.</td>
                        <td>{{ config('session.lifetime') / 60 }}&nbsp;h</td>
                    </tr>
                    <tr>
                        <td><code>XSRF-TOKEN</code></td>
                        <td>Protection du formulaire de contact contre les attaques CSRF.</td>
                        <td>{{ config('session.lifetime') / 60 }}&nbsp;h</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <p>
            Les polices de caractères sont hébergées sur ce site : aucune donnée n’est transmise à Google Fonts.
            Vous pouvez aussi bloquer ou supprimer les cookies depuis les réglages de votre navigateur
            (<a href="https://www.cnil.fr/fr/cookies-et-autres-traceurs/comment-se-proteger/maitriser-votre-navigateur" target="_blank" rel="noopener noreferrer">conseils de la CNIL</a>).
        </p>

        <h2 id="logs">5. Journaux techniques</h2>
        <p>
            Comme tout site web, l’hébergeur enregistre des journaux de connexion (adresse IP, date et heure, page
            demandée, navigateur) nécessaires à la sécurité et au bon fonctionnement du service. Ces données reposent
            sur l’intérêt légitime (article 6.1.f du RGPD) et sont conservées au maximum 12&nbsp;mois.
        </p>

        <h2 id="droits">6. Vos droits</h2>
        <p>Vous disposez à tout moment des droits suivants sur vos données :</p>
        <ul>
            <li>droit d’accès, de rectification et d’effacement ;</li>
            <li>droit à la limitation du traitement et droit d’opposition ;</li>
            <li>droit à la portabilité de vos données ;</li>
            <li>droit de définir des directives relatives au sort de vos données après votre décès.</li>
        </ul>
        <p>
            Pour les exercer, écrivez à <a href="mailto:{{ config('site.email') }}">{{ config('site.email') }}</a>.
            Une réponse vous sera apportée dans un délai d’un mois. Si vous estimez que vos droits ne sont pas
            respectés, vous pouvez introduire une réclamation auprès de la CNIL
            (<a href="https://www.cnil.fr/fr/plaintes" target="_blank" rel="noopener noreferrer">cnil.fr/plaintes</a>,
            3 place de Fontenoy, TSA 80715, 75334 Paris Cedex 07).
        </p>

        <h2 id="securite">7. Sécurité</h2>
        <p>
            Le site est servi exclusivement en HTTPS. Les données ne sont ni vendues, ni louées, ni cédées à des tiers,
            et ne font l’objet d’aucune prise de décision automatisée ni d’aucun profilage.
        </p>

        <h2 id="modifications">8. Modifications</h2>
        <p>
            Cette politique peut évoluer, notamment en cas de changement des outils utilisés. La date de dernière
            mise à jour figure en haut de cette page.
        </p>
    </x-legal-page>
@endsection
