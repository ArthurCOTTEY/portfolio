## Le besoin

Coiffeurs, esthéticiennes, coachs, tatoueurs, praticiens bien-être… Beaucoup de professionnels qui travaillent sur rendez-vous passent encore une partie de leur journée au téléphone, et chaque rendez-vous non honoré est un créneau perdu. Les outils existants sont souvent chers, complexes ou pensés pour de grandes structures.

Cekale part d’une idée simple : **une page de réservation à partager, un agenda pour toute l’équipe et des rappels automatiques**, prêts en quelques minutes et sans carte bancaire.

## Ce que fait Cekale

- **Réservation en ligne 24 h/24** : une page au nom de l’établissement, à partager sur les réseaux, par QR code ou à intégrer sur son propre site grâce à un widget.
- **Agenda d’équipe** : chaque praticien voit son planning, le secrétariat voit tout le monde et prend les rendez-vous au téléphone.
- **Moins d’absences** : confirmation et rappel par e-mail, blocage automatique des clients qui ne viennent pas, acompte facultatif.
- **Fidélisation** : avis clients, carte de fidélité, relance « reprenez rendez-vous », liste d’attente quand un créneau se libère.
- **Cas réels du métier** : prestations à domicile avec temps de trajet, séances de groupe, cabines et salles partagées, options et prestations enchaînées, rendez-vous récurrents, jours fériés.
- **Pilotage** : tableau de bord, statistiques de remplissage et chiffre d’affaires estimé, fichier clients avec export et effacement RGPD.

## Les défis techniques

### Ne jamais vendre deux fois le même créneau

C’est le cœur du produit. Les créneaux libres sont calculés à partir des horaires, des absences, des fermetures, des rendez-vous existants et des calendriers personnels de chaque praticien. Tout est converti en périodes UTC jour par jour, avec le fuseau de l’établissement : les nuits de changement d’heure sont gérées explicitement, et les temps de battement entre deux rendez-vous s’additionnent sans jamais chevaucher une période occupée.

Deux clients peuvent pourtant cliquer sur le même créneau à la même seconde. La réservation passe donc par trois barrières : une vérification complète, puis une transaction qui verrouille les praticiens concernés (toujours dans le même ordre, pour éviter les interblocages) et revérifie, et enfin une **contrainte d’unicité en base** comme dernier filet de sécurité. MySQL ne sait pas interdire des périodes qui se chevauchent : une colonne qui passe à `NULL` à l’annulation permet de réutiliser un créneau libéré tout en gardant l’unicité.

### Synchroniser Google Agenda et Apple iCloud

Chaque membre de l’équipe connecte ses propres calendriers. Côté Google : OAuth 2.0 et appels directs à l’API Calendar, sans le SDK officiel jugé trop lourd. Côté Apple, iCloud ne propose pas d’OAuth : j’ai écrit un **client CalDAV minimal**, sans dépendance, qui fonctionne avec un mot de passe d’application.

Les occupations personnelles bloquent les créneaux, les rendez-vous sont recopiés dans le calendrier du praticien, et un collègue ne voit jamais le titre des événements privés des autres. Un cache de cinq minutes et une copie de secours de 24 heures font qu’une panne chez Google ou Apple ne bloque jamais la page de réservation.

### Encaisser un acompte sans toucher à l’argent

Avec **Stripe Connect**, chaque établissement relie son propre compte Stripe : il reste le commerçant et l’argent ne transite jamais par Cekale. Le client paie sur une page Stripe hébergée ; pendant trente minutes, le rendez-vous bloque le créneau sans déclencher le moindre e-mail ni la moindre synchronisation, puis il est confirmé ou libéré automatiquement. L’acompte est remboursé à l’annulation, sauf annulation tardive, et conservé en cas d’absence.

### Une application installable, avec notifications

L’équipe peut installer Cekale sur son téléphone comme une application (PWA) et recevoir une notification à chaque réservation, même application fermée. J’ai utilisé le **Web Push standard**, sans Firebase ni compte chez un tiers : les messages sont chiffrés de bout en bout pour l’appareil. Comme une notification s’affiche sur l’écran verrouillé, elle ne contient jamais le nom du client. Le serveur n’accepte d’envoyer qu’aux adresses des services officiels des navigateurs, pour se protéger des attaques de type SSRF.

### Être trouvé sur Google… et par les IA

L’application est en React, mais le site vitrine est rendu par le serveur en Blade, pour des pages rapides et entièrement lisibles par les moteurs : pages par métier, par fonctionnalité et par thème, comparatifs sourcés, outils gratuits, lexique, blog, données structurées et fichier `llms.txt` pour les assistants IA. À l’inverse, l’application, les pages de réservation et les liens envoyés aux clients ne sont jamais indexés.

## Méthode et qualité

- **Plus de 1 300 tests automatisés** (Pest), analyse statique avec PHPStan, formatage contrôlé et intégration continue sur GitHub Actions.
- **53 décisions techniques documentées** (ADR) : chaque choix structurant est écrit, avec son contexte et ses conséquences.
- **Préproduction puis production** : un script de déploiement refuse de mettre en ligne un code différent de celui testé en préproduction.
- **Sécurité** : double authentification, passkeys, isolation stricte des données entre établissements, liens signés pour les clients, suivi des erreurs interne avec des messages nettoyés de toute donnée personnelle.
- **RGPD** : export et effacement des fiches clients, aucune donnée de santé, hébergement en France chez O2Switch, mesure d’audience Matomo sans cookie.
