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
