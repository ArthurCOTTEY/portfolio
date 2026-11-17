<?php

namespace App\Enums;

enum ProjectStatus: string
{
    case Online = 'online';
    case InProgress = 'in_progress';
    case Archived = 'archived';

    public function getLabel(): string
    {
        return match ($this) {
            self::Online => 'En ligne',
            self::InProgress => 'En cours',
            self::Archived => 'Archivé',
        };
    }

    /**
     * Classe Tailwind de la pastille affichée sur le site.
     */
    public function badgeClass(): string
    {
        return match ($this) {
            self::Online => 'bg-green-500',
            self::InProgress => 'bg-yellow-400',
            self::Archived => 'bg-gray-300',
        };
    }
}
