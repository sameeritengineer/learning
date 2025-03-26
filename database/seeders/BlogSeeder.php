<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Blog; // Import your Blog model
use Illuminate\Support\Str;

class BlogSeeder extends Seeder
{
    public function run()
    {
        Blog::factory(50)->create();
    }
}
