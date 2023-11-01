<?php

namespace Cp\JobPost\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobPost extends Model
{
    use HasFactory;

    public function jobPostCvs()
    {
        return $this->hasMany(JobPostCv::class);
    }

    public function fi()
    {
        return $this->featured_image ?: 'not_found.png';
    }
}
