<?php

namespace Cp\Membership\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class UserProfile extends Model
{
    use HasFactory;

    public function fi()
    {
        return $this->profile_pic ?: 'profile.jpg';
    }



    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function packages()
    {
        return $this->hasMany(MembershipPackage::class);
    }


    public function religion()
    {
        return $this->belongsTo(ProfileReligion::class);
    }

    public function cast()
    {
        return $this->belongsTo(ProfileCast::class);
    }
}