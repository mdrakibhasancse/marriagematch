<?php

namespace Cp\Gallery\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GalleryItem extends Model
{
    use HasFactory;
    public function fi()
    {
        return $this->image ?: 'fi.jpg';
    }
}
