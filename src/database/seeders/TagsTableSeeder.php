<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = [
            [
                'tag_name' => 'Trải nghiệm',
                'tag_slug' => 'trai-nghiem',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tag_name' => 'Văn hóa',
                'tag_slug' => 'van-hoa',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tag_name' => 'Ẩm thực',
                'tag_slug' => 'am-thuc',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('tags')->insert($tags);
    }
}
