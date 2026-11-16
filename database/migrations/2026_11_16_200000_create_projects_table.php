<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('tagline');
            $table->text('description');
            $table->string('role')->nullable();
            $table->json('highlights')->nullable();
            $table->json('stack')->nullable();
            $table->string('url')->nullable();
            $table->string('repository_url')->nullable();
            $table->string('image')->nullable();
            $table->string('status', 20)->default('online');
            $table->unsignedSmallInteger('year')->nullable();
            $table->boolean('is_published')->default(true);
            $table->unsignedSmallInteger('position')->default(0)->index();
            $table->timestamps();
        });

        // Premier projet présenté sur le site (modifiable ensuite dans /admin).
        DB::table('projects')->insert([
            'name' => 'Cekale',
            'slug' => 'cekale',
            'tagline' => 'Prise de rendez-vous en ligne pour les professionnels',
            'description' => 'Cekale est un logiciel de réservation en ligne pour les indépendants, salons, instituts et cabinets qui reçoivent sur rendez-vous : coiffeurs, barbiers, esthéticiennes, coachs, tatoueurs… Les clients réservent seuls, 24 h/24, depuis une page à partager ; l’équipe gère un agenda commun synchronisé avec Google et Apple, et les rappels automatiques limitent les rendez-vous non honorés.',
            'role' => 'Projet personnel : conception, développement full stack, design et mise en production.',
            'highlights' => json_encode([
                'Calcul des créneaux libres sans double réservation : praticiens, cabines et salles, séances de groupe',
                'Agenda d’équipe synchronisé avec Google Agenda et Apple iCloud',
                'Acompte en ligne avec Stripe Connect, carte de fidélité, avis clients et liste d’attente',
                'Application installable (PWA) avec notifications push',
                'Widget de réservation à intégrer sur WordPress, Wix ou Squarespace',
                'Site vitrine pensé pour le référencement : pages métiers, blog, données structurées et llms.txt',
                'Sécurité : double authentification, passkeys et conformité RGPD',
            ], JSON_UNESCAPED_UNICODE),
            'stack' => json_encode(['Laravel 13', 'PHP 8.4', 'React 19', 'TypeScript', 'Inertia.js', 'Tailwind CSS', 'shadcn/ui', 'Stripe Connect', 'Pest', 'PHPStan'], JSON_UNESCAPED_UNICODE),
            'url' => 'https://www.cekale.fr',
            'repository_url' => null,
            'image' => 'projects/cekale.webp',
            'status' => 'online',
            'year' => 2026,
            'is_published' => true,
            'position' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
