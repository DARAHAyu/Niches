<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use App\Models\PurchaseOrder;
use App\Models\Category;
use App\Models\User;

class PurchaseOrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('purchase_orders')->delete(); // purchase_ordersテーブルのデータを一旦削除する

        // purchase_ordersテーブルのオートインクリメント値をリセット
        DB::statement('ALTER SEQUENCE purchase_orders_id_seq RESTART WITH 1');

        // カテゴリｰを取得
        $category = Category::first();

        // 10件分のテストデータを作成
        User::all()->each(function ($user) use ($category) {
            PurchaseOrder::factory()->create([
                'user_id' => $user->id,
                'category_id' => $category->id,
            ]);
        });
    }
}
