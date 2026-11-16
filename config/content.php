<?php

/*
|--------------------------------------------------------------------------
| Contenus éditoriaux structurés
|--------------------------------------------------------------------------
|
| Ces contenus sont affichés sur la page d'accueil ET repris dans les
| données structurées (JSON-LD) et le fichier llms.txt : les garder ici
| évite de les dupliquer.
|
*/

return [

    'services' => [
        [
            'title' => 'Applications web sur mesure',
            'text' => 'CRM, outils métier, back-offices, API : je conçois des applications adaptées à vos processus, avec une architecture claire qui reste facile à faire évoluer.',
            'points' => ['Analyse du besoin et modélisation', 'Back-end Laravel robuste et testé', 'Interfaces d’administration ergonomiques'],
        ],
        [
            'title' => 'Sites vitrines & e-commerce',
            'text' => 'Des sites rapides, accessibles et bien référencés, qui présentent votre activité ou vendent vos produits, avec une attention particulière à la performance.',
            'points' => ['Intégration responsive et accessible', 'SEO technique et performances', 'Catalogue, paiement et gestion des commandes'],
        ],
        [
            'title' => 'Maintenance & évolution',
            'text' => 'Reprise de projets existants, corrections, nouvelles fonctionnalités, montée de version : je fais vivre les applications dans la durée sans casser l’existant.',
            'points' => ['Reprise et audit de code', 'Refactoring et mises à jour', 'Optimisation des performances'],
        ],
    ],

    'experience' => [
        [
            'period' => 'Aujourd’hui',
            'title' => 'Développeur web full stack — CDI en agence web',
            'text' => 'Je développe des applications web sur mesure pour les clients de l’agence en m’appuyant sur un framework PHP interne. Je participe à la conception de nouvelles fonctionnalités, à la maintenance et à l’évolution de projets existants, du back-end jusqu’à l’intégration des interfaces.',
            'tags' => ['PHP', 'Framework interne', 'Projets clients', 'Maintenance'],
            'color' => 'bg-green-500',
        ],
        [
            'period' => 'Alternance',
            'title' => 'BTS SIO — option SLAM',
            'text' => 'Formation en développement d’applications (Solutions Logicielles et Applications Métiers) suivie en alternance. Elle m’a permis d’allier les bases théoriques — algorithmique, bases de données, conception objet — à une première expérience concrète en entreprise sur des projets réels.',
            'tags' => ['Développement d’applications', 'Bases de données', 'Alternance'],
            'color' => 'bg-blue-600',
        ],
        [
            'period' => 'Formation',
            'title' => 'Bac Pro Systèmes Numériques',
            'text' => 'Mes premiers pas dans l’informatique : réseaux, matériel et systèmes numériques. C’est là qu’est née mon envie de passer du côté du code et de construire mes propres applications.',
            'tags' => ['Systèmes', 'Réseaux', 'Premiers programmes'],
            'color' => 'bg-yellow-400',
        ],
    ],

    'faq' => [
        [
            'question' => 'Qui est Arthur Cottey ?',
            'answer' => 'Arthur Cottey est un développeur web full stack basé à Tours, en Centre-Val de Loire. Spécialisé en PHP et Laravel, il travaille actuellement en CDI dans une agence web où il conçoit et maintient des applications sur mesure.',
        ],
        [
            'question' => 'Quelles technologies utilisez-vous ?',
            'answer' => 'Principalement PHP et Laravel côté serveur, Vue.js et Nuxt côté interface, ainsi que Tailwind CSS, MySQL et Git au quotidien. Je choisis les outils en fonction du projet plutôt que l’inverse.',
        ],
        [
            'question' => 'Sur quels types de projets intervenez-vous ?',
            'answer' => 'Sites vitrines, plateformes e-commerce, CRM et outils métier, API et back-offices. J’interviens aussi bien sur des projets neufs que sur la reprise, la maintenance et l’évolution d’applications existantes.',
        ],
        [
            'question' => 'Quels projets avez-vous réalisés ?',
            'answer' => 'Mon projet principal est Cekale (cekale.fr), un logiciel de prise de rendez-vous en ligne pour les professionnels — salons, instituts, cabinets et indépendants — que j’ai conçu et développé de bout en bout avec Laravel, React et Inertia.js. Il est présenté en détail dans la section « Projets » de cette page.',
        ],
        [
            'question' => 'Comment vous contacter ?',
            'answer' => 'Le plus simple est d’utiliser le formulaire de contact en bas de cette page, d’écrire à arthur.cottey1@gmail.com ou de m’envoyer un message sur LinkedIn. Je réponds généralement rapidement.',
        ],
    ],

];
