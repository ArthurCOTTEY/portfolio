<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

#[Fillable(['name', 'image', 'position'])]
class Skill extends Model
{
    /**
     * @return BelongsTo<SkillCategory, $this>
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(SkillCategory::class, 'skill_category_id');
    }

    /**
     * Icône encodée en data URI : aucune requête supplémentaire, aucun lien
     * symbolique "storage" requis, et un SVG chargé via <img> ne peut pas
     * exécuter de script.
     */
    protected function iconDataUri(): Attribute
    {
        return Attribute::get(function (): ?string {
            $disk = Storage::disk('public');

            if (! $this->image || ! $disk->exists($this->image)) {
                return null;
            }

            // Certains SVG sont détectés en text/xml : on se fie alors à l'extension.
            $mime = match (strtolower(pathinfo($this->image, PATHINFO_EXTENSION))) {
                'svg' => 'image/svg+xml',
                'png' => 'image/png',
                'webp' => 'image/webp',
                default => null,
            };

            return $mime ? "data:{$mime};base64,".base64_encode($disk->get($this->image)) : null;
        })->shouldCache();
    }
}
