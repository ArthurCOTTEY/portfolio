<?php

use App\Enums\ProjectStatus;
use App\Models\Project;
use App\Models\User;

it('présente Cekale sur la page d’accueil dès la migration', function () {
    $this->get('/')
        ->assertOk()
        ->assertSee('id="projets"', false)
        ->assertSee('Cekale')
        ->assertSee('https://www.cekale.fr', false)
        ->assertSee('/media/projects/cekale.webp', false)
        ->assertSee('"@type":"SoftwareApplication"', false);

    expect(public_path('media/projects/cekale.webp'))->toBeFile();
});

it('masque les projets non publiés', function () {
    Project::factory()->create(['name' => 'Projet secret', 'slug' => 'secret', 'is_published' => false]);

    $this->get('/')->assertDontSee('Projet secret');
});

it('affiche les projets dans le llms.txt', function () {
    $this->get('/llms.txt')->assertOk()->assertSee('## Projets')->assertSee('### Cekale');
});

it('gère les projets depuis l’admin', function () {
    config(['site.admin_emails' => ['admin@example.com']]);
    $this->actingAs(User::factory()->create(['email' => 'admin@example.com']));

    $this->get('/admin/projets')->assertOk()->assertSee('Cekale');
    $this->get('/admin/projets/create')->assertOk();
    $this->get('/admin/projets/'.Project::where('slug', 'cekale')->value('id').'/edit')->assertOk()->assertSee('Stripe Connect');
});

it('libelle les statuts en français', function () {
    expect(ProjectStatus::Online->getLabel())->toBe('En ligne')
        ->and(Project::where('slug', 'cekale')->first()->status)->toBe(ProjectStatus::Online);
});

it('publie l’étude de cas de Cekale', function () {
    $this->get('/projets/cekale')
        ->assertOk()
        ->assertSee('<h1', false)
        ->assertSee('Ne jamais vendre deux fois le même créneau')
        ->assertSee('1 300+')
        ->assertSee('/media/projects/cekale/agenda.webp', false)
        ->assertSee('"@type":"TechArticle"', false)
        ->assertSee('<link rel="canonical" href="'.route('projects.show', 'cekale').'">', false);

    foreach (Project::where('slug', 'cekale')->first()->galleryItems() as $item) {
        expect(public_path(parse_url($item['url'], PHP_URL_PATH)))->toBeFile();
    }
});

it('relie l’accueil, le sitemap et le llms.txt à l’étude de cas', function () {
    $url = route('projects.show', 'cekale');

    $this->get('/')->assertSee($url, false)->assertSee('Lire l’étude de cas');
    $this->get('/sitemap.xml')->assertSee($url, false);
    $this->get('/llms.txt')->assertSee($url, false);
});

it('ne publie pas d’étude de cas vide ou masquée', function () {
    Project::factory()->create(['slug' => 'sans-etude', 'case_study' => null]);
    Project::factory()->create(['slug' => 'masque', 'case_study' => '## Texte', 'is_published' => false]);

    $this->get('/projets/sans-etude')->assertNotFound();
    $this->get('/projets/masque')->assertNotFound();
    $this->get('/projets/inconnu')->assertNotFound();
});

it('échappe le HTML saisi dans l’étude de cas', function () {
    Project::factory()->create([
        'slug' => 'test-xss',
        'case_study' => "## Titre\n\n<script>alert(1)</script>\n\n[lien](javascript:alert(1))",
    ]);

    $this->get('/projets/test-xss')
        ->assertOk()
        ->assertDontSee('<script>alert(1)</script>', false)
        ->assertDontSee('href="javascript:', false);
});
