<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use App\Models\SalesOrder;
use App\Models\Category;
use App\Models\User;

class SalesOrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sales_orders')->delete(); // sales_ordersテーブルのデータを一旦削除する

        // sales_ordersテーブルのオートインクリメント値をリセット
        DB::statement('ALTER SEQUENCE sales_orders_id_seq RESTART WITH 1');

        // カテゴリｰを取得
        $category = Category::first();

        // 10件分のテストデータを作成
        User::all()->each(function ($user) use ($category) {
            SalesOrder::factory()->create([
                'user_id' => $user->id,
                'category_id' => $category->id,
            ]);
        });
    }
}
