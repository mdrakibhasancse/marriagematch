<?php

namespace Cp\Membership\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfileSettingField extends Model
{
    use HasFactory;

    public function values()
    {
        return $this->hasMany(ProfileSettingValue::class);
    }
}
