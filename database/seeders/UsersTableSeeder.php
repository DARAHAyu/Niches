<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete(); // categoriesテーブルのデータを一旦削除する

        // usersテーブルのオートインクリメント値をリセット
        DB::statement('ALTER TABLE users AUTO_INCREMENT = 1');

        // 10人分のテストデータを作成
        User::factory(10)->create();
    }
}
