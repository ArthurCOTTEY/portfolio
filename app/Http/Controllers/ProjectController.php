<?php

namespace App\Http\Controllers;

use App\Content\Project;
use Illuminate\View\View;

class ProjectController extends Controller
{
    public function __invoke(string $slug): View
    {
        $project = Project::find($slug);

        abort_unless($project?->hasCaseStudy(), 404);

        return view('pages.project', [
            'project' => $project,
            'otherProjects' => Project::all()->reject(fn (Project $other) => $other->slug === $project->slug),
        ]);
    }
}
