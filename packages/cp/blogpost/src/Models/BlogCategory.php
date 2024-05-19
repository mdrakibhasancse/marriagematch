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
        return $this->posts()->whereActive(true)->whereStatus('published')->latest()->first();
    }

    public function latest2Posts()
    {
        return $this->posts()->whereActive(true)->whereStatus('published')->latest()->skip(1)->take(2)->get();
    }
}