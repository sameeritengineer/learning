<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TechFactor extends Model
{
    //
     protected $table = 'tech_factors';
     protected $fillable = [
        'season',
        'episode_title',
        'episode_number',
        'thumbnail_image',
        'video_link',
        'spotify_link',
        'radio_link',
    ];

    public static function seasons()
    {
        return [
            'season_1' => 'Season 1',
            'season_2' => 'Season 2',
            'season_3' => 'Season 3',
            'season_4' => 'Season 4',
        ];
    }
}
