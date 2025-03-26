<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PastWork extends Model
{
    //
    protected $table = 'past_works'; // Ensure this matches your database table name

    protected $fillable = [
        'title',
        'description',
        'company_logo',
        'user_logo',
    ];
}
