<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CaseStudy extends Model
{
    //
     protected $table = 'case_studies';
     protected $fillable = [
        'title',
        'description',
        'thumbnail_image',
        'whole_case_study',
    ];
}
