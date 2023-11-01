<?php

namespace Cp\Membership\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfileSubcategory extends Model
{
    use HasFactory;

    public function profileCategory()
    {
        return $this->belongsTo(ProfileCategory::class);
    }

    public function fi()
    {
        return $this->feature_image ?: 'not_found.png';
    }
}
