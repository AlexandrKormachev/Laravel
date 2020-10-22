<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\BlogPost;
use Illuminate\Support\Str;

class BlogPostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = BlogPost::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->sentence(rand(3, 8));
        $text = $this->faker->realText(rand(1000, 4000));
        $isPublished = (rand(1, 5)) > 1;
        $createdAt = $this->faker->dateTimeBetween('-3 months', '-2 months');
        $data = [
            'category_id' => rand(1, 10),
            'user_id' => (rand(1, 5) == 5) ? 1 : 2,
            'slug' => Str::of($title)->slug(),
            'title' => $title,
            'excerpt' => $this->faker->text(40, 100),
            'content_raw' => $text,
            'content_html' => $text,
            'is_published' => $isPublished,
            'published_at' => $isPublished ? $this->faker->dateTimeBetween('-2 months', '-1 days') : null,
            'created_at' => $createdAt,
            'updated_at' => $createdAt
        ];
        return $data;
    }
}
