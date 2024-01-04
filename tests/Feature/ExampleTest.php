<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */

    // テストとしてmy/sales/indexにアクセス可能かどうかを確認
    public function test_my_sales(): void
    {
        // テスト用のユーザを作成
        $user = User::factory()->create();

        // 作成したユーザで認証
        $response = $this->actingAs($user)->get('/my/sales/index');

        $response->assertStatus(200);
    }
}
