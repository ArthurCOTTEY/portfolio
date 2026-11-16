<?php

namespace Database\Factories;

use App\Enums\ProjectStatus;
use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Project>
 */
class ProjectFactory extends Factory
{
    public function definition(): array
    {
        $name = fake()->unique()->words(2, true);

        return [
            'name' => Str::title($name),
            'slug' => Str::slug($name),
            'tagline' => fake()->sentence(6),
            'description' => fake()->paragraph(),
            'highlights' => [fake()->sentence(), fake()->sentence()],
            'stack' => ['Laravel', 'Vue.js'],
            'status' => ProjectStatus::Online,
            'year' => 2026,
            'is_published' => true,
            'position' => 0,
        ];
    }
}
