<?php

namespace Cp\BlogPost\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\Translatable\HasTranslations;
use voku\helper\UTF8;
use voku\helper\ASCII;

class BlogPost extends Model
{
    use HasFactory, HasTranslations;

    public $translatable = ['title', 'excerpt', 'description'];

    public function blogCategories()
    {
        return $this->belongsToMany(BlogCategory::class, 'blog_category_posts');
    }

    public function files()
    {
        return $this->hasMany(BlogPostFile::class);
    }

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

    function localeTitleShow() 
    {
        $a = json_decode(json_encode($this->getTranslations('title')), true);
        $code = app()->getLocale();

        if ($a && $code !== null && array_key_exists($code, $a) && $a[$code] !== null) {
            return $a[$code];
        } else {
            foreach ($a as $k => $item) {
                if ($item !== null) {
                    return $item;
                }
            }
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

   function localeExcerptShow() 
    {
        $a = json_decode(json_encode($this->getTranslations('excerpt')), true);
        $code = app()->getLocale();

        if ($a && $code !== null && array_key_exists($code, $a) && $a[$code] !== null) {
            return $a[$code];
        } else {
            foreach ($a as $k => $item) {
                if ($item !== null) {
                    return $item;
                }
            }
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

    function localeDescriptionShow() 
    {
        $a = json_decode(json_encode($this->getTranslations('description')), true);
        $code = app()->getLocale();

        // dd($a, $code , array_key_exists($code, $a), $a[$code]);
        if ($a && $code !== null && array_key_exists($code, $a) && $a[$code] !== "<p><br></p>" ) { 
            return $a[$code];
        } else {
          
            foreach ($a as $k => $item) {
                
                if ($item !== null) {
                    return $item;
                }
            }
        }
    }



   
}