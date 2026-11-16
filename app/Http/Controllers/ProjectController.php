<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\View\View;

class ProjectController extends Controller
{
    public function __invoke(Project $project): View
    {
        abort_unless($project->is_published && $project->hasCaseStudy(), 404);

        return view('pages.project', [
            'project' => $project,
            'otherProjects' => Project::query()->forDisplay()->whereKeyNot($project->getKey())->get(),
        ]);
    }
}
