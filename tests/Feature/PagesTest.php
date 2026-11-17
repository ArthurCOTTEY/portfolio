<?php

use App\Support\Analytics;

it('affiche la page d’accueil avec les compétences', function () {
    $this->get('/')
        ->assertOk()
        ->assertSee('<html lang="fr-FR">', false)
        ->assertSee('Arthur Cottey')
        ->assertSee('Back-end')
        ->assertSee('Laravel')
        ->assertSee('/images/skills/laravel.svg', false)
        ->assertSee('application/ld+json', false)
        ->assertSee('<link rel="canonical"', false)
        ->assertDontSee('fonts.googleapis.com');
});

it('a une icône pour chaque compétence', function () {
    foreach (config('content.skills') as $category) {
        foreach ($category['items'] as $skill) {
            expect(public_path("images/skills/{$skill['icon']}.svg"))->toBeFile();
        }
    }
});

it('affiche les pages légales', function (string $url, string $title) {
    $this->get($url)->assertOk()->assertSee($title)->assertSee('BreadcrumbList');
})->with([
    ['/politique-de-confidentialite', 'Politique de confidentialité'],
    ['/mentions-legales', 'Mentions légales'],
]);

it('redirige les anciennes URL multilingues', function (string $from, string $to) {
    $this->get($from)->assertMovedPermanently()->assertRedirect($to);
})->with([
    ['/fr', '/'],
    ['/en', '/'],
    ['/fr/politique-de-confidentialite', '/politique-de-confidentialite'],
    ['/en/privacy-policy', '/politique-de-confidentialite'],
]);

it('renvoie une 404 personnalisée', function () {
    $this->get('/page-inexistante')->assertNotFound()->assertSee('Cette page n’existe pas');
});

it('n’affiche aucun bandeau cookies ni traceur tiers', function () {
    $this->get('/')
        ->assertOk()
        ->assertDontSee('cookie-banner', false)
        ->assertDontSee('googletagmanager.com', false)
        ->assertDontSee('matomo-url', false);
});

it('active Matomo sans cookie quand il est configuré', function () {
    config(['site.analytics.matomo_url' => 'https://stats.example.fr', 'site.analytics.matomo_site_id' => '3']);

    $this->get('/')
        ->assertSee('<meta name="matomo-url" content="https://stats.example.fr/">', false)
        ->assertSee('<meta name="matomo-site-id" content="3">', false);

    $this->get('/politique-de-confidentialite')
        ->assertSee('https://stats.example.fr/index.php?module=CoreAdminHome&amp;action=optOutJS', false);
});

it('ignore une configuration Matomo invalide', function (?string $url, ?string $id) {
    config(['site.analytics.matomo_url' => $url, 'site.analytics.matomo_site_id' => $id]);

    expect(Analytics::enabled())->toBeFalse();
})->with([
    'http non chiffré' => ['http://stats.example.fr', '1'],
    'identifiants dans l’URL' => ['https://user:pass@stats.example.fr', '1'],
    'ID manquant' => ['https://stats.example.fr', null],
    'ID invalide' => ['https://stats.example.fr', 'abc'],
    'URL vide' => [null, '1'],
]);
