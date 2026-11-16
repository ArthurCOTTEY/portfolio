<?php

use App\Models\SkillCategory;
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

it('ne charge aucun traceur sans consentement', function () {
    config(['site.analytics.enabled' => true]);

    $this->get('/')
        ->assertOk()
        ->assertSee('data-ga-id="'.config('site.analytics.ga_id').'"', false)
        ->assertDontSee('googletagmanager.com');
});

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
