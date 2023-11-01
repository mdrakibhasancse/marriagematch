<?php

namespace Cp\Membership\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfileCast extends Model
{
    use HasFactory;

    public function religion()
    {
        return $this->belongsTo(ProfileReligion::class);
    }
}