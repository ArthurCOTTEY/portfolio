<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\SkillCategory;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __invoke(): View
    {
        return view('pages.home', [
            'projects' => Project::query()->forDisplay()->get(),
            'skillCategories' => SkillCategory::query()->forDisplay()->get(),
        ]);
    }
}
