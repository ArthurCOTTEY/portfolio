<?php

namespace App\Http\Controllers;

use App\Content\Project;
use App\Content\Skills;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;

/**
 * Fichiers destinés aux moteurs de recherche et aux assistants IA,
 * générés à partir du contenu réel du site pour rester à jour.
 */
class SeoController extends Controller
{
    public function sitemap(): Response
    {
        $contentUpdatedAt = Carbon::createFromTimestamp(max(
            filemtime(resource_path('views/pages/home.blade.php')),
            filemtime(config_path('content.php')),
        ));

        $legalUpdatedAt = Carbon::parse(config('site.legal_updated_at'));

        $urls = [
            ['loc' => route('home'), 'lastmod' => $contentUpdatedAt, 'priority' => '1.0'],
            ...Project::all()
                ->filter->hasCaseStudy()
                ->map(fn (Project $project) => ['loc' => route('projects.show', $project->slug), 'lastmod' => $project->updated_at, 'priority' => '0.8'])
                ->all(),
            ['loc' => route('privacy'), 'lastmod' => $legalUpdatedAt, 'priority' => '0.3'],
            ['loc' => route('legal-notice'), 'lastmod' => $legalUpdatedAt, 'priority' => '0.3'],
        ];

        return response()
            ->view('seo.sitemap', compact('urls'))
            ->header('Content-Type', 'application/xml; charset=UTF-8');
    }

    public function llms(): Response
    {
        return response()
            ->view('seo.llms', [
                'projects' => Project::all(),
                'skillCategories' => Skills::categories(),
            ])
            ->header('Content-Type', 'text/plain; charset=UTF-8');
    }
}
