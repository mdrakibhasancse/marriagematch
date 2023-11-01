<?php

namespace Cp\Menupage\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

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
}
