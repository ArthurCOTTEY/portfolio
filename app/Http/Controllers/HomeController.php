<?php

namespace App\Http\Controllers;

use App\Content\Project;
use App\Content\Skills;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __invoke(): View
    {
        return view('pages.home', [
            'projects' => Project::all(),
            'skillCategories' => Skills::categories(),
        ]);
    }
}
