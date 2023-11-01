<?php

namespace Cp\Admin\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cp\Admin\Models\LanguageTranslation;

class Language extends Model
{
    use HasFactory;

    public function translations(){
        return $this->hasMany(LanguageTranslation::class, 'lang', 'language_code');
    }
}