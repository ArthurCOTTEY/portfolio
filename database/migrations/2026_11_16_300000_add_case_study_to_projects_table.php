<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->longText('case_study')->nullable()->after('description');
            $table->json('metrics')->nullable()->after('stack');
            $table->json('gallery')->nullable()->after('image');
        });

        // Étude de cas de Cekale (modifiable ensuite dans /admin).
        DB::table('projects')->where('slug', 'cekale')->update([
            'case_study' => file_get_contents(database_path('data/projects/cekale.md')),
            'metrics' => json_encode([
                ['value' => '55', 'label' => 'fonctionnalités livrées'],
                ['value' => '1 300+', 'label' => 'tests automatisés'],
                ['value' => '53', 'label' => 'décisions techniques documentées'],
                ['value' => '15', 'label' => 'métiers accompagnés'],
            ], JSON_UNESCAPED_UNICODE),
            'gallery' => json_encode([
                ['image' => 'projects/cekale/reservation.webp', 'caption' => 'La page de réservation : le client choisit sa prestation et son créneau, sans créer de compte.'],
                ['image' => 'projects/cekale/agenda.webp', 'caption' => 'L’agenda d’équipe, synchronisé avec Google Agenda et Apple iCloud.'],
                ['image' => 'projects/cekale/pilotage.webp', 'caption' => 'Le tableau de bord : rendez-vous du jour, demandes à traiter et chiffres du mois.'],
                ['image' => 'projects/cekale/personnalisation.webp', 'caption' => 'Options et prestations enchaînées, avec le total de la durée et du prix.'],
                ['image' => 'projects/cekale/calendriers.webp', 'caption' => 'Chaque praticien connecte ses propres calendriers.'],
                ['image' => 'projects/cekale/securite.webp', 'caption' => 'Double authentification, passkeys et données isolées par établissement.'],
            ], JSON_UNESCAPED_UNICODE),
            'updated_at' => now(),
        ]);
    }

    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn(['case_study', 'metrics', 'gallery']);
        });
    }
};
