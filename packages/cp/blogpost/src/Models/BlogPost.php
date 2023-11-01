<?php

namespace Cp\BlogPost\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
    use HasFactory;

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
}