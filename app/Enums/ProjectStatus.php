<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum ProjectStatus: string implements HasColor, HasLabel
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

    public function getColor(): string
    {
        return match ($this) {
            self::Online => 'success',
            self::InProgress => 'warning',
            self::Archived => 'gray',
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
