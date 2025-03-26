<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IndustryInsight extends Model
{
    //
    protected $table = 'industry_insights';
    protected $fillable = ['thumbnail_image', 'pdf_title', 'pdf_link'];
}
