<?php

namespace App\Http\Controllers;

use App\Models\SkillCategory;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __invoke(): View
    {
        return view('pages.home', [
            'skillCategories' => SkillCategory::query()->forDisplay()->get(),
        ]);
    }
}
