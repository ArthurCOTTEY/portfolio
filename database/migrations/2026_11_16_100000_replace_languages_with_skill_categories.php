<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Le site n'est plus traduit : on remplace les tables "languages" et
 * "language_translations" par une table "skill_categories" monolingue
 * (les textes français existants sont conservés) et on ajoute un ordre
 * d'affichage aux catégories et aux compétences.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('skill_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->unsignedSmallInteger('position')->default(0)->index();
            $table->timestamps();
        });

        $translations = Schema::hasTable('language_translations')
            ? DB::table('language_translations')->get()->groupBy('language_id')
            : collect();

        foreach (DB::table('languages')->orderBy('id')->get() as $index => $language) {
            $localized = $translations->get($language->id, collect());
            $translation = $localized->firstWhere('locale', 'fr') ?? $localized->first();

            DB::table('skill_categories')->insert([
                'id' => $language->id,
                'name' => $translation->name ?? $language->name,
                'description' => $translation->description ?? $language->description,
                'position' => $index,
                'created_at' => $language->created_at,
                'updated_at' => $language->updated_at,
            ]);
        }

        Schema::table('skills', function (Blueprint $table) {
            $table->foreignId('skill_category_id')->nullable()->after('id');
            $table->unsignedSmallInteger('position')->default(0)->after('image');
        });

        DB::table('skills')->update([
            'skill_category_id' => DB::raw('language_id'),
            'position' => DB::raw('id'),
        ]);

        Schema::table('skills', function (Blueprint $table) {
            $table->dropConstrainedForeignId('language_id');
        });

        Schema::table('skills', function (Blueprint $table) {
            $table->foreignId('skill_category_id')->nullable(false)->change();
            $table->string('image')->nullable()->change();
            $table->foreign('skill_category_id')->references('id')->on('skill_categories')->cascadeOnDelete();
        });

        Schema::dropIfExists('language_translations');
        Schema::dropIfExists('languages');
    }

    public function down(): void
    {
        Schema::create('languages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description')->nullable();
            $table->timestamps();
        });

        Schema::create('language_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('language_id')->constrained()->cascadeOnDelete();
            $table->string('locale')->index();
            $table->string('name');
            $table->text('description')->nullable();
            $table->unique(['language_id', 'locale']);
        });

        foreach (DB::table('skill_categories')->orderBy('id')->get() as $category) {
            DB::table('languages')->insert([
                'id' => $category->id,
                'name' => $category->name,
                'description' => mb_substr((string) $category->description, 0, 255) ?: null,
                'created_at' => $category->created_at,
                'updated_at' => $category->updated_at,
            ]);

            DB::table('language_translations')->insert([
                'language_id' => $category->id,
                'locale' => 'fr',
                'name' => $category->name,
                'description' => $category->description,
            ]);
        }

        Schema::table('skills', function (Blueprint $table) {
            $table->foreignId('language_id')->nullable()->after('image');
        });

        DB::table('skills')->update(['language_id' => DB::raw('skill_category_id')]);

        Schema::table('skills', function (Blueprint $table) {
            $table->dropConstrainedForeignId('skill_category_id');
            $table->dropColumn('position');
        });

        Schema::table('skills', function (Blueprint $table) {
            $table->foreign('language_id')->references('id')->on('languages')->cascadeOnDelete();
        });

        Schema::dropIfExists('skill_categories');
    }
};
