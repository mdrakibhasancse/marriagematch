<?php

namespace Cp\Gallery\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    public function fi()
    {
        return $this->featured_image ?: 'not_found.png';
    }

    public function images()
    {
        return $this->hasMany(GalleryItem::class, 'gallery_id');
    }
}
