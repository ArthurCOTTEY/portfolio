<?php

namespace App\Content;

use Illuminate\Support\Collection;

/**
 * Compétences de « Ce que je maîtrise », lues dans config/content.php (« skills »).
 */
final class Skills
{
    /**
     * @return Collection<int, object{name: string, description: ?string, skills: Collection<int, object{name: string, icon_url: ?string}>}>
     */
    public static function categories(): Collection
    {
        return collect(config('content.skills', []))->map(fn (array $category) => (object) [
            'name' => $category['name'],
            'description' => $category['description'] ?? null,
            'skills' => collect($category['items'] ?? [])->map(fn (array $skill) => (object) [
                'name' => $skill['name'],
                'icon_url' => self::iconUrl($skill['icon'] ?? null),
            ]),
        ]);
    }

    private static function iconUrl(?string $icon): ?string
    {
        return $icon && is_file(public_path("images/skills/{$icon}.svg")) ? asset("images/skills/{$icon}.svg") : null;
    }
}
