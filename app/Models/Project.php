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
use Illuminate\Support\Str;

#[Fillable([
    'name', 'slug', 'tagline', 'description', 'case_study', 'role', 'highlights', 'stack', 'metrics',
    'url', 'repository_url', 'image', 'gallery', 'status', 'year', 'is_published', 'position',
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
            'metrics' => 'array',
            'gallery' => 'array',
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

    public function hasCaseStudy(): bool
    {
        return filled($this->case_study);
    }

    /**
     * Étude de cas en HTML. Le Markdown est saisi dans l'admin : tout HTML brut est
     * échappé et les liens dangereux (javascript:…) sont refusés.
     */
    public function caseStudyHtml(): string
    {
        return Str::markdown((string) $this->case_study, [
            'html_input' => 'escape',
            'allow_unsafe_links' => false,
        ]);
    }

    /**
     * Images de la galerie avec leur URL publique.
     *
     * @return list<array{url: string, caption: ?string}>
     */
    public function galleryItems(): array
    {
        return collect($this->gallery ?? [])
            ->filter(fn ($item) => filled($item['image'] ?? null))
            ->map(fn ($item) => [
                'url' => Storage::disk(self::DISK)->url($item['image']),
                'caption' => $item['caption'] ?? null,
            ])
            ->values()
            ->all();
    }

    protected function imageUrl(): Attribute
    {
        return Attribute::get(fn (): ?string => $this->image ? Storage::disk(self::DISK)->url($this->image) : null);
    }
}
