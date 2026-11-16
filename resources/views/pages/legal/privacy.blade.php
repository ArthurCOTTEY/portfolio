@extends('layouts.app')

@section('title', 'Politique de confidentialité et cookies — Arthur Cottey')
@section('description', 'Données collectées sur arthurcottey.fr, finalités, durées de conservation, cookies utilisés (Google Analytics avec consentement) et exercice de vos droits RGPD.')

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

        <h2 id="audience">3. Mesure d’audience (Google Analytics)</h2>
        <p>
            <strong>Uniquement si vous l’acceptez</strong>, le site utilise Google Analytics 4 pour produire des
            statistiques de fréquentation (pages consultées, durée de visite, type d’appareil et de navigateur, pays
            et ville approximatifs, site de provenance). Aucun script Google n’est chargé tant que vous n’avez pas
            donné votre accord.
        </p>
        <ul>
            <li><strong>Base légale :</strong> votre consentement (article 6.1.a du RGPD et article 82 de la loi Informatique et Libertés), que vous pouvez retirer à tout moment.</li>
            <li><strong>Sous-traitant :</strong> Google Ireland Limited (Gordon House, Barrow Street, Dublin 4, Irlande).</li>
            <li><strong>Transfert hors UE :</strong> les données peuvent être traitées par Google LLC aux États-Unis. Ce transfert est encadré par la décision d’adéquation de la Commission européenne du 10 juillet 2023 (Data Privacy Framework), Google LLC étant certifiée.</li>
            <li><strong>Durée de conservation :</strong> cookies 13&nbsp;mois maximum ; données de statistiques 14&nbsp;mois maximum.</li>
            <li><strong>Pas de publicité :</strong> les signaux publicitaires et le partage de données à des fins marketing ne sont pas utilisés.</li>
        </ul>

        <h2 id="cookies">4. Cookies et traceurs</h2>
        <p>Voici la liste exhaustive des cookies pouvant être déposés par ce site :</p>
        <div class="overflow-x-auto">
            <table>
                <thead>
                    <tr>
                        <th scope="col">Cookie</th>
                        <th scope="col">Finalité</th>
                        <th scope="col">Durée</th>
                        <th scope="col">Consentement</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><code>{{ config('session.cookie') }}</code></td>
                        <td>Session technique nécessaire au fonctionnement du site.</td>
                        <td>{{ config('session.lifetime') / 60 }}&nbsp;h</td>
                        <td>Non requis</td>
                    </tr>
                    <tr>
                        <td><code>XSRF-TOKEN</code></td>
                        <td>Protection du formulaire de contact contre les attaques CSRF.</td>
                        <td>{{ config('session.lifetime') / 60 }}&nbsp;h</td>
                        <td>Non requis</td>
                    </tr>
                    <tr>
                        <td><code>{{ config('site.consent.cookie') }}</code></td>
                        <td>Mémorise votre choix concernant les cookies.</td>
                        <td>6&nbsp;mois</td>
                        <td>Non requis</td>
                    </tr>
                    <tr>
                        <td><code>_ga</code>, <code>_ga_*</code></td>
                        <td>Google Analytics : distinguer les visiteurs et les sessions pour les statistiques.</td>
                        <td>13&nbsp;mois</td>
                        <td><strong>Requis</strong></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <p>
            Votre choix est conservé 6&nbsp;mois, après quoi il vous est de nouveau demandé. Refuser les cookies de
            mesure d’audience n’a aucune conséquence sur votre navigation. Les polices de caractères sont hébergées
            sur ce site : aucune donnée n’est transmise à Google Fonts.
        </p>
        <p>
            <button type="button" data-open-cookie-preferences class="btn btn-yellow">Modifier mes préférences cookies</button>
        </p>
        <p>
            Vous pouvez également bloquer ou supprimer les cookies depuis les réglages de votre navigateur. Pour en
            savoir plus : <a href="https://www.cnil.fr/fr/cookies-et-autres-traceurs/comment-se-proteger/maitriser-votre-navigateur" target="_blank" rel="noopener noreferrer">maîtriser votre navigateur (CNIL)</a>.
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
            <li>droit de retirer votre consentement à tout moment, sans remettre en cause les traitements déjà effectués ;</li>
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
            Cette politique peut évoluer, notamment en cas de changement des outils utilisés. En cas de modification
            importante concernant les cookies, votre consentement vous sera de nouveau demandé.
        </p>
    </x-legal-page>
@endsection
