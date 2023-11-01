<?php

namespace Cp\Membership\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserEducationRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'passed_degree',
        'passed_department',
        'organization_name',
        'organization_address',
        'year_from',
        'year_to',
        'passed_year',
        'passed_grade ',
        'user_id',
    ];
}
