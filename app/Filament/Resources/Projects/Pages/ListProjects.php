<?php

namespace App\Filament\Resources\Projects\Pages;

use App\Filament\Resources\Projects\ProjectResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListProjects extends ListRecords
{
    protected static string $resource = ProjectResource::class;

    protected ?string $subheading = 'Glissez-déposez les lignes pour changer l’ordre d’affichage sur le site.';

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
