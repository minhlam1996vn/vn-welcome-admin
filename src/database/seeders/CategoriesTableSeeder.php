<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'category_name' => 'Con người Việt Nam',
                'category_slug' => 'con-nguoi-viet-nam',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_name' => 'Ngày lễ và những trải nghiệm',
                'category_slug' => 'ngay-le-va-nhung-trai-nghiem',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_name' => 'Tin tức thị trường',
                'category_slug' => 'tin-tuc-thi-truong',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_name' => '63 Tỉnh thành',
                'category_slug' => '63-tinh-thanh',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_name' => 'Ẩm thực - Du lịch',
                'category_slug' => 'am-thuc-du-lich',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_name' => 'Blog',
                'category_slug' => 'blog',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_name' => 'Âm thanh - Hình ảnh',
                'category_slug' => 'am-thanh-hinh-anh',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('categories')->insert($categories);
    }
}
