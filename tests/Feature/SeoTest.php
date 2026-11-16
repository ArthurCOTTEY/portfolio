<?php

use App\Models\SkillCategory;

it('génère un sitemap XML', function () {
    $this->get('/sitemap.xml')
        ->assertOk()
        ->assertHeader('Content-Type', 'application/xml; charset=UTF-8')
        ->assertSee(route('home'), false)
        ->assertSee(route('privacy'), false)
        ->assertSee(route('legal-notice'), false);
});

it('génère un llms.txt à jour', function () {
    SkillCategory::factory()->create(['name' => 'Front-end'])->skills()->create(['name' => 'Vue.js']);

    $this->get('/llms.txt')
        ->assertOk()
        ->assertHeader('Content-Type', 'text/plain; charset=UTF-8')
        ->assertSee('# Arthur Cottey')
        ->assertSee('PHP & Laravel', false)
        ->assertSee('Vue.js');
});
