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

        for ($i = 1; $i <= 1000; $i++) {
            $title = $faker->sentence;

            $article = Article::create([
                'uuid' => Str::uuid(),
                'user_id' => 1,
                'category_id' => $faker->numberBetween(1, 7),
                'article_title' => $title,
                'article_slug' => Str::slug($title),
                'article_description' => 'Description: ' . $title,
                'article_content' => $faker->paragraph,
                'status' => 2,
                'publication_date' => now(),
                'created_at' => now(),
                'updated_at' => now(),
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
