<?php

use App\Content\Project;

it('présente Cekale sur la page d’accueil', function () {
    $this->get('/')
        ->assertOk()
        ->assertSee('id="projets"', false)
        ->assertSee('Cekale')
        ->assertSee('https://www.cekale.fr', false)
        ->assertSee('/media/projects/cekale.webp', false)
        ->assertSee('"@type":"SoftwareApplication"', false)
        ->assertSee('Lire l’étude de cas');
});

it('publie l’étude de cas de Cekale', function () {
    $this->get('/projets/cekale')
        ->assertOk()
        ->assertSee('Ne jamais vendre deux fois le même créneau')
        ->assertSee('1 300+')
        ->assertSee('/media/projects/cekale/agenda.webp', false)
        ->assertSee('"@type":"TechArticle"', false)
        ->assertSee('<link rel="canonical" href="'.route('projects.show', 'cekale').'">', false);
});

it('a tous les visuels des projets', function () {
    foreach (Project::all() as $project) {
        foreach ([$project->image_url, ...array_column($project->galleryItems(), 'url')] as $url) {
            expect(public_path(ltrim((string) parse_url($url, PHP_URL_PATH), '/')))->toBeFile();
        }
    }
});

it('relie le sitemap et le llms.txt à l’étude de cas', function () {
    $url = route('projects.show', 'cekale');

    $this->get('/sitemap.xml')->assertSee($url, false);
    $this->get('/llms.txt')->assertSee('## Projets')->assertSee('### Cekale')->assertSee($url, false);
});

it('renvoie une 404 pour un projet inconnu ou sans étude de cas', function () {
    config(['content.projects' => [[...config('content.projects.0'), 'slug' => 'sans-etude', 'case_study' => null]]]);

    $this->get('/projets/sans-etude')->assertNotFound();
    $this->get('/projets/inconnu')->assertNotFound();
});
