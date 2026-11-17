<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

/**
 * Compétences et projets sont désormais versionnés dans config/content.php
 * (plus de panneau d'administration). Retire les anciennes tables de contenu
 * d'une base existante ; sans effet sur une nouvelle installation.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::dropIfExists('skills');
        Schema::dropIfExists('skill_categories');
        Schema::dropIfExists('projects');
        Schema::dropIfExists('language_translations');
        Schema::dropIfExists('languages');
    }

    public function down(): void
    {
        // Contenu versionné dans le code : rien à recréer.
    }
};
