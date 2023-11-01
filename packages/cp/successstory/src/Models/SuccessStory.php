<?php

namespace Cp\SuccessStory\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuccessStory extends Model
{
    use HasFactory;


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // public function femaleUser()
    // {
    //     return $this->belongsTo(User::class, 'famele_user_id');
    // }

    public function fi()
    {
        return $this->featured_image ?: 'not_found.png';
    }
}
