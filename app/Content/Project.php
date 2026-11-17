<?php

namespace App\Content;

use App\Enums\ProjectStatus;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

/**
 * Projet présenté sur le site, lu dans config/content.php (« projects »).
 */
final class Project
{
    public function __construct(
        public readonly string $slug,
        public readonly string $name,
        public readonly string $tagline,
        public readonly string $description,
        public readonly ?string $role,
        public readonly ProjectStatus $status,
        public readonly ?int $year,
        public readonly ?string $url,
        public readonly ?string $repository_url,
        public readonly ?string $image_url,
        public readonly ?string $caseStudyPath,
        /** @var list<string> */
        public readonly array $highlights,
        /** @var list<string> */
        public readonly array $stack,
        /** @var list<array{value: string, label: string}> */
        public readonly array $metrics,
        /** @var list<array{url: string, caption: ?string}> */
        public readonly array $gallery,
        public readonly ?Carbon $created_at,
        public readonly ?Carbon $updated_at,
    ) {}

    /**
     * @return Collection<int, self>
     */
    public static function all(): Collection
    {
        return collect(config('content.projects', []))->map(fn (array $data) => self::fromArray($data))->values();
    }

    public static function find(string $slug): ?self
    {
        return self::all()->firstWhere('slug', $slug);
    }

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        $caseStudy = filled($data['case_study'] ?? null) ? resource_path('content/'.$data['case_study']) : null;
        $caseStudy = $caseStudy && is_file($caseStudy) ? $caseStudy : null;

        return new self(
            slug: $data['slug'],
            name: $data['name'],
            tagline: $data['tagline'],
            description: $data['description'],
            role: $data['role'] ?? null,
            status: ProjectStatus::from($data['status'] ?? 'online'),
            year: $data['year'] ?? null,
            url: $data['url'] ?? null,
            repository_url: $data['repository_url'] ?? null,
            image_url: filled($data['image'] ?? null) ? asset($data['image']) : null,
            caseStudyPath: $caseStudy,
            highlights: $data['highlights'] ?? [],
            stack: $data['stack'] ?? [],
            metrics: $data['metrics'] ?? [],
            gallery: collect($data['gallery'] ?? [])
                ->map(fn (array $item) => ['url' => asset($item['image']), 'caption' => $item['caption'] ?? null])
                ->all(),
            created_at: filled($data['published_at'] ?? null) ? Carbon::parse($data['published_at']) : null,
            updated_at: Carbon::createFromTimestamp(max(
                filemtime(config_path('content.php')),
                $caseStudy ? filemtime($caseStudy) : 0,
            )),
        );
    }

    public function hasCaseStudy(): bool
    {
        return $this->caseStudyPath !== null;
    }

    /**
     * Étude de cas en HTML (Markdown versionné ; HTML brut échappé par précaution).
     */
    public function caseStudyHtml(): string
    {
        return $this->hasCaseStudy()
            ? Str::markdown((string) file_get_contents($this->caseStudyPath), ['html_input' => 'escape', 'allow_unsafe_links' => false])
            : '';
    }

    /**
     * @return list<array{url: string, caption: ?string}>
     */
    public function galleryItems(): array
    {
        return $this->gallery;
    }
}
