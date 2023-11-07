<?php

namespace Cp\SuccessStory\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class SuccessStory extends Model
{
    use HasFactory, HasTranslations;

    public $translatable = ['title', 'excerpt', 'description'];

    

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // public function femaleUser()
    // {
    //     return $this->belongsTo(User::class, 'famele_user_id');
    // }

    public function fi()
    {
        return $this->featured_image ?: 'not_found.png';
    }



    function localeTitle($code) 
    {
        $a = json_decode(json_encode($this->getTranslations('title')), true);
        if($a)
        {
            if(array_key_exists($code, $a))
            {
                return $a[$code];
            }
            return null;
            
        }
    }

    function localeExcerpt($code) 
    {
        $a = json_decode(json_encode($this->getTranslations('excerpt')), true);
        if($a)
        {
            if(array_key_exists($code, $a))
            {
                return $a[$code];
            }
            return null;
            
        }
    }

    function localeDescription($code) 
    {
        $a = json_decode(json_encode($this->getTranslations('description')), true);
        if($a)
        {
            if(array_key_exists($code, $a))
            {
                return $a[$code];
            }
            return null;
            
        }
    }
}