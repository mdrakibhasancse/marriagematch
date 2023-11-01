<?php

namespace Cp\Membership\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfileReligion extends Model
{
    use HasFactory;

    public function casts()
    {
        return $this->hasMany(ProfileCast::class);
    }
}
