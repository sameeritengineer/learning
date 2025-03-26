<?php

namespace Database\Factories;

use App\Models\BlogCategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class BlogCategoryFactory extends Factory
{
    protected $model = BlogCategory::class;

    public function definition()
    {
        $name = $this->faker->word;
        return [
            'title' => ucfirst($name),
            'description' => Str::slug($name),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
