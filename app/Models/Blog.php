<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $table = 'blogs'; // Define the table name

    protected $fillable = [
        'title',
        'description',
        'mini_description',
        'slug',
        'status',
        'is_featured',
        'cover_image',
        'thumbnail_image',
        'category_id',
    ];

    /**
     * Relationship: A blog belongs to a category.
     */
    public function category()
    {
        return $this->belongsTo(BlogCategory::class, 'category_id');
    }
}
