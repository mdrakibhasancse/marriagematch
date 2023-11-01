<?php

namespace Cp\BlogPost\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogPostFile extends Model
{
    use HasFactory;
    const SUPPORTED_IMAGE_TYPES =  ['jpg', 'png', 'svg', 'gip', 'jpeg', 'pjpeg', 'gif', 'webp', 'ico'];

    const SUPPORTED_WORD_TYPES  =  ['docx', 'doc', 'ppt', 'pptx', 'xlsx', 'csv'];

    const SUPPORTED_PDF_TYPES   =  ['pdf'];
}
