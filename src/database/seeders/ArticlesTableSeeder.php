<?php

namespace Database\Seeders;

use App\Models\Article;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();

        for ($i = 1; $i <= 100; $i++) {
            $title = $faker->sentence;

            $article = Article::create([
                'user_id' => 1,
                'category_id' => $faker->numberBetween(1, 7),
                'title' => $title,
                'slug' => Str::slug($title),
                'image_url' => 'https://placehold.jp/1280x720.png', //'https://via.placeholder.com/1600x900.png/0066bb?text=16:9', //$faker->imageUrl()
                'content' => $faker->paragraph,
                'created_at' => $faker->dateTime(),
                'updated_at' => $faker->dateTime()
            ]);

            $tagIdElements = rand(1, 3);
            $tagIds = collect(range(1, 3))->shuffle()->take($tagIdElements)->toArray();

            foreach ($tagIds as $tagId) {
                DB::table('article_tags')->insert([
                    'article_id' => $article->id,
                    'tag_id' => $tagId,
                ]);
            }
        }
    }
}
