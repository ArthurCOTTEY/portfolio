<?php

use App\Models\SkillCategory;
use App\Models\User;
use Filament\Facades\Filament;

it('réserve le panneau aux adresses autorisées', function () {
    config(['site.admin_emails' => ['admin@example.com']]);
    $panel = Filament::getPanel('admin');

    expect(User::factory()->make(['email' => 'Admin@example.com'])->canAccessPanel($panel))->toBeTrue()
        ->and(User::factory()->make(['email' => 'intrus@example.com'])->canAccessPanel($panel))->toBeFalse();
});

it('affiche la liste des compétences dans l’admin', function () {
    config(['site.admin_emails' => ['admin@example.com']]);

    $this->actingAs(User::factory()->create(['email' => 'admin@example.com']))
        ->get('/admin/competences')
        ->assertOk()
        ->assertSee('Compétences');
});

it('affiche les formulaires de création et d’édition', function () {
    config(['site.admin_emails' => ['admin@example.com']]);
    $category = SkillCategory::factory()->create(['name' => 'Outils']);
    $category->skills()->create(['name' => 'Git']);

    $this->actingAs(User::factory()->create(['email' => 'admin@example.com']));

    $this->get('/admin/competences/create')->assertOk()->assertSee('Ajouter une technologie');
    $this->get("/admin/competences/{$category->id}/edit")->assertOk()->assertSee('Git');
});
