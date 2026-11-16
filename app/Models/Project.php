<?php

namespace App\Models;

use App\Enums\ProjectStatus;
use Database\Factories\ProjectFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

#[Fillable([
    'name', 'slug', 'tagline', 'description', 'role', 'highlights', 'stack',
    'url', 'repository_url', 'image', 'status', 'year', 'is_published', 'position',
])]
class Project extends Model
{
    /** @use HasFactory<ProjectFactory> */
    use HasFactory;

    /**
     * Disque des visuels : servi directement depuis public/media,
     * sans dépendre du lien symbolique "storage".
     */
    public const DISK = 'media';

    protected function casts(): array
    {
        return [
            'highlights' => 'array',
            'stack' => 'array',
            'status' => ProjectStatus::class,
            'is_published' => 'boolean',
            'year' => 'integer',
        ];
    }

    /**
     * @param  Builder<self>  $query
     */
    public function scopeForDisplay(Builder $query): void
    {
        $query->where('is_published', true)->orderBy('position')->orderByDesc('year');
    }

    protected function imageUrl(): Attribute
    {
        return Attribute::get(fn (): ?string => $this->image ? Storage::disk(self::DISK)->url($this->image) : null);
    }
}
