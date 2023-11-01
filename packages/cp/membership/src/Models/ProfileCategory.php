<?php

namespace Cp\Membership\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfileCategory extends Model
{
    use HasFactory;

    public function profileSubcategories()
    {
        return $this->hasMany(ProfileSubcategory::class);
    }

    public function activeSubcats()
    {
        return $this->hasMany(ProfileSubcategory::class)->whereActive(true);
    }


    public function fi()
    {
        return $this->feature_image ?: 'not_found.png';
    }
}
