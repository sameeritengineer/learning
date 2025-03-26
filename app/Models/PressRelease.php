<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PressRelease extends Model
{
    //
    protected $fillable = ['title', 'description', 'whole_press_release', 'thumbnail_image'];
}
