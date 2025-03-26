<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OperatedDomain extends Model
{
    //
        //
    protected $table = 'operated_domains'; // Ensure this matches your database table name

    protected $fillable = ['title', 'description', 'logos'];

    protected $casts = [
        'logos' => 'array',
    ];
}
