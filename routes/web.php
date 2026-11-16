<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SeoController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');

Route::post('/contact', ContactController::class)
    ->middleware('throttle:contact')
    ->name('contact.store');

Route::get('/projets/{project:slug}', ProjectController::class)->name('projects.show');

Route::view('/politique-de-confidentialite', 'pages.legal.privacy')->name('privacy');
Route::view('/mentions-legales', 'pages.legal.notice')->name('legal-notice');

Route::get('/sitemap.xml', [SeoController::class, 'sitemap'])->name('sitemap');
Route::get('/llms.txt', [SeoController::class, 'llms'])->name('llms');

// Anciennes URL multilingues : redirections permanentes pour conserver le référencement.
Route::permanentRedirect('/fr', '/');
Route::permanentRedirect('/en', '/');
Route::permanentRedirect('/fr/politique-de-confidentialite', '/politique-de-confidentialite');
Route::permanentRedirect('/en/privacy-policy', '/politique-de-confidentialite');
