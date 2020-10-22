<?php

namespace Database\Seeders;

use App\Models\BlogPost;
use Database\Factories\BlogPostFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTabelSeeder::class);
        $this->call(BlogCategoriesSeeder::class);
        BlogPost::factory()->count(100)->create();
    }
}
