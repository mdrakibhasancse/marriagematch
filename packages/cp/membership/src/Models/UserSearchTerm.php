<?php

namespace Cp\Membership\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSearchTerm extends Model
{
    use HasFactory;

   protected $fillable = [
        'addedby_id',
    ];

    public function religion()
    {
        return $this->belongsTo(ProfileReligion::class);
    }

    public function cast()
    {
        return $this->belongsTo(ProfileCast::class);
    }
   
}