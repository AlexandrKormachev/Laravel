<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BlogCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [];
        $cName = 'Без категории';
        $categories[] = [
            'title' => $cName,
            'slug' => Str::of($cName)->slug(),
            'parent_id' => 0,
        ];

        for ($i = 1; $i <= 11; $i++) {
            $cName = "Категория №" . $i;
            $parent_id = ($i > 4) ? rand(1, 4) : 1;

            $categories[] = [
                'title' => $cName,
                'slug' => Str::of($cName)->slug(),
                'parent_id' => $parent_id,
            ];
        }

        \DB::table('blog_categories')->insert($categories);
    }
}
