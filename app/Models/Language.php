<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;

class Language extends Model
{
    use Translatable;

    // ❌ ici tu ne mets PAS les champs traduits
    protected $fillable = [];

    public $translatedAttributes = [
        'name',
        'description',
    ];

    public function skills()
    {
        return $this->hasMany(Skill::class);
    }
}
