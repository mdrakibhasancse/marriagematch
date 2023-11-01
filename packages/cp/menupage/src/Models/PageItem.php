<?php

namespace Cp\Menupage\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageItem extends Model
{
    use HasFactory;

    public function page()
    {
        return $this->belongsTo(Page::class);
    }
}
