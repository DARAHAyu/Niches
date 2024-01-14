<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->delete(); // categoriesテーブルのデータを一旦削除する

        // categoriesテーブルのオートインクリメント値をリセット
        DB::statement('ALTER SEQUENCE categories_id_seq RESTART WITH 1');

        // categoriesテーブルのテストデータを作成
        $categories = ['ゲーム', '料理', 'スポーツ', '音楽', 'その他'];

        foreach ($categories as $category) {
            DB::table('categories')->insert([
                'category' => $category,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

    }
}
