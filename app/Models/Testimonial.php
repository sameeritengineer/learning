<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{

    protected $table = 'testimonials'; // Ensure this matches your database table name

    protected $fillable = [
        'name',
        'position',
        'testimonial_description',
        'company_logo',
        'user_logo',
    ];
}
