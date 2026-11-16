<?php

namespace App\Filament\Resources\SkillCategories\Pages;

use App\Filament\Resources\SkillCategories\SkillCategoryResource;
use App\Models\SkillCategory;
use Filament\Resources\Pages\CreateRecord;

class CreateSkillCategory extends CreateRecord
{
    protected static string $resource = SkillCategoryResource::class;

    /**
     * Les nouvelles catégories s'ajoutent à la fin de la liste.
     */
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['position'] = (SkillCategory::max('position') ?? -1) + 1;

        return $data;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
