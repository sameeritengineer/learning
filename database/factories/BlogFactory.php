<?php

namespace Database\Factories;
use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class BlogFactory extends Factory
{
    protected $model = Blog::class;

    public function definition()
    {
        $title = $this->faker->sentence(6);
        return [
            'title' => $title,
            'description' => $this->faker->paragraphs(5, true), // Generates long text
            'mini_description' => $this->faker->text(150), // Small summary
            'slug' => Str::slug($title),
            'status' => $this->faker->randomElement(['active', 'inactive']),
            'is_featured' => $this->faker->boolean(30), // 30% chance to be featured
            'category_id' => BlogCategory::inRandomOrder()->first()->id ?? BlogCategory::factory()->create()->id,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
