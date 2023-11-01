<?php

namespace Cp\Membership\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfileParameter extends Model
{
    use HasFactory;


    function children()
    {
        return ProfileParameter::where('field_name', $this->field_name)->orderBy('field_value')->get();
    }
}