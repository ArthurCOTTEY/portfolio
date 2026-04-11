<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;

Route::get('/', function (Request $request) {

    $locale = session('locale')
        ?? substr($request->getPreferredLanguage(['fr', 'en']), 0, 2)
        ?? 'fr';

    if (!in_array($locale, ['fr', 'en'])) {
        $locale = 'fr';
    }

    return redirect("/$locale");
});

Route::group(['prefix' => '{locale}'], function () {

    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
});

Route::prefix('fr')->group(function () {
    Route::get('/politique-de-confidentialite', function () {
        app()->setLocale('fr');
        return view('legal.privacy');
    })->name('privacy.fr');
});

Route::prefix('en')->group(function () {
    Route::get('/privacy-policy', function () {
        app()->setLocale('en');
        return view('legal.privacy');
    })->name('privacy.en');
});

