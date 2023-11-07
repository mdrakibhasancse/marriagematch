<?php


namespace Cp\BlogPost\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Session;
use Config;

class BlogCategory extends Model
{
    use HasFactory;

    public function posts()
    {
        return $this->belongsToMany(BlogPost::class, 'blog_category_posts', 'blog_category_id', 'blog_post_id');
    }

    public function latestFirstPost()
    {

        if(Session::has('locale')){
            $locale = Session::get('locale',Config::get('app.locale'));
        }
        else{
            $locale = env('DEFAULT_LANGUAGE');
        }
        return $this->posts()->whereLocale('title', $locale)->whereActive(true)->whereStatus('published')->latest()->first();
    }

    public function latest2Posts()
    {
        if(Session::has('locale')){
            $locale = Session::get('locale',Config::get('app.locale'));
        }
        else{
            $locale = env('DEFAULT_LANGUAGE');
        }
        return $this->posts()->whereLocale('title', $locale)->whereActive(true)->whereStatus('published')->latest()->skip(1)->take(2)->get();
    }
}