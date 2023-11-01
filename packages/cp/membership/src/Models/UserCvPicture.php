<?php

namespace Cp\Membership\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCvPicture extends Model
{
    use HasFactory;

    public function fi()
    {
        return $this->profile_pic ?: 'profile.jpg';
    }

    public function firstPic()
    {
        return $this->extra_pic_first ?: 'profile.jpg';
    }

    public function secondPic()
    {
        return $this->extra_pic_second ?: 'profile.jpg';
    }

    public function thirdPic()
    {
        return $this->extra_pic_third ?: 'profile.jpg';
    }

    public function cv()
    {
        return $this->cv ?: '';
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function userProfile()
    {
        return $this->belongsTo(UserProfile::class, 'user_id', 'user_id');
    }
}
