<?php

namespace Cp\Menupage\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Page extends Model
{
    use HasFactory, HasTranslations;

    public $translatable = ['name','excerpt'];

    public function addedBy()
    {
        return $this->belongsTo(User::class, 'addedby_id');
    }

    public function menus()
    {
        return $this->belongsToMany(Menu::class, 'menu_pages');
    }

    public function pageItems()
    {
        return $this->hasMany(PageItem::class, 'page_id', 'id')->whereActive(true);
    }

    function localeName($code) 
    {
        $a = json_decode(json_encode($this->getTranslations('name')), true);
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
}