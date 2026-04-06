<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    public $fillable = ['name', 'image'];

    public function language()
    {
        return $this->belongsTo(Language::class);
    }
}
