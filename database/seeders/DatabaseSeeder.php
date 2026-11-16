<?php

namespace Database\Seeders;

use App\Models\SkillCategory;
use App\Models\User;
use Illuminate\Database\Seeder;

/**
 * Données de démonstration pour le développement local uniquement.
 * En production, le contenu se gère depuis le panneau /admin.
 */
class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        if (app()->isProduction()) {
            $this->command?->warn('Seeder ignoré en production.');

            return;
        }

        User::factory()->create([
            'name' => 'Admin local',
            'email' => 'admin@example.com',
        ]);

        $categories = [
            'Back-end' => ['Applications, API et logique métier robustes.', ['PHP', 'Laravel', 'MySQL']],
            'Front-end' => ['Interfaces rapides, accessibles et responsives.', ['JavaScript', 'Vue.js', 'Nuxt', 'Tailwind CSS']],
            'Outils' => ['Un workflow fiable du développement à la mise en ligne.', ['Git', 'Composer', 'Vite']],
        ];

        foreach (array_keys($categories) as $position => $name) {
            [$description, $skills] = $categories[$name];

            SkillCategory::create(compact('name', 'description', 'position'))
                ->skills()
                ->createMany(collect($skills)->map(fn (string $skill, int $i) => ['name' => $skill, 'position' => $i])->all());
        }
    }
}
