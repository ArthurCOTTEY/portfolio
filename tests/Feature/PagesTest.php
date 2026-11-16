<?php

use App\Models\SkillCategory;
use App\Support\Analytics;
use Illuminate\Support\Facades\Storage;

it('affiche la page d’accueil avec les compétences', function () {
    SkillCategory::factory()
        ->create(['name' => 'Back-end'])
        ->skills()->create(['name' => 'Laravel']);

    $this->get('/')
        ->assertOk()
        ->assertSee('<html lang="fr-FR">', false)
        ->assertSee('Arthur Cottey')
        ->assertSee('Back-end')
        ->assertSee('Laravel')
        ->assertSee('application/ld+json', false)
        ->assertSee('<link rel="canonical"', false)
        ->assertDontSee('fonts.googleapis.com');
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

it('intègre les icônes de compétences sans lien symbolique', function () {
    Storage::fake('public')->put('skills-icons/php.svg', '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1 1"/>');

    SkillCategory::factory()->create()->skills()->createMany([
        ['name' => 'PHP', 'image' => 'skills-icons/php.svg'],
        ['name' => 'Sans icône', 'image' => 'skills-icons/absente.svg'],
    ]);

    $this->get('/')->assertOk()
        ->assertSee('src="data:image/svg+xml;base64,', false)
        ->assertSee('Sans icône');
});
