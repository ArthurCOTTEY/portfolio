<?php

namespace App\Http\Controllers;

use App\Models\Language;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        $languages = Language::with('skills')
            ->orderBy('id', 'asc')
            ->get();

        return view('home.index', compact('languages'));
    }
}
