<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use App\Models\Category;
use Tests\TestCase;

class SalesOrdersControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     *
     * @return void
     */

    // テストとしてmy/sales/indexにアクセス可能かどうかを確認
    public function test_sales_index(): void
    {
        // テスト用のユーザを作成
        $user = User::factory()->create();

        // 作成したユーザで認証
        $response = $this->actingAs($user)->get('/my/sales/index');

        $response->assertStatus(200);
    }

    // テストとしてmy/sales/createにアクセス可能かどうかを確認
    public function test_sales_create(): void
    {
        // テスト用のユーザを作成
        $user = User::factory()->create();

        // 作成したユーザで認証
        $response = $this->actingAs($user)->get('/my/sales/create');

        $response->assertStatus(200);
    }

    // テストとしてmy/sales/storeにアクセス可能かどうかを確認
    public function test_sales_store(): void
    {
        // テスト用のユーザを作成
        $user = User::factory()->create();

        // テスト用のカテゴリーを作成
        $category = Category::factory()->create();

        $formData = [ 
            'title' => 'テストタイトル',
            'sales_abstract' => 'テスト概要',
            'category_id' => $category->id,
            'budget' => 1000,
            'schedule' => '2021-01-01',
        ];

        // 作成したユーザで認証
        $response = $this->actingAs($user)->post('/my/sales/store', $formData);

        $response->assertStatus(302);
        $this->assertDatabaseHas('sales_orders', [
            'title' => $formData['title'],
            'sales_abstract' => $formData['sales_abstract'],
            'category_id' => $formData['category_id'],
            'budget' => $formData['budget'],
            'schedule' => $formData['schedule'],
        ]);
    }

    // テストとしてmy/sales/destroyにアクセス可能かどうかを確認
    public function test_sales_destroy(): void
    {
        // テスト用のユーザを作成
        $user = User::factory()->create();

        // テスト用のカテゴリーを作成
        $category = Category::factory()->create();

        $formData = [
            'title' => 'テストタイトル',
            'sales_abstract' => 'テスト概要',
            'category_id' => $category->id,
            'budget' => 1000,
            'schedule' => '2021-01-01',
        ];

        // 作成したユーザで認証
        $response = $this->actingAs($user)->post('/my/sales/store', $formData);

        $response->assertStatus(302);
        $this->assertDatabaseHas('sales_orders', [
            'user_id' => $user->id,
        ]);

        $sales_order = $user->sales_orders()->first();

        $response = $this->actingAs($user)->delete('/sales/destroy/' . $sales_order->id);

        $response->assertStatus(302);
        $this->assertDatabaseMissing('sales_orders', [
            'title' => $formData['title'],
            'sales_abstract' => $formData['sales_abstract'],
            'category_id' => $formData['category_id'],
            'budget' => $formData['budget'],
            'schedule' => $formData['schedule'],
        ]);
    }

    // テストとしてmy/sales/showにアクセス可能かどうかを確認
    public function test_sales_show(): void
    {
        // テスト用のユーザを作成
        $user = User::factory()->create();

        // テスト用のカテゴリーを作成
        $category = Category::factory()->create();

        $formData = [
            'title' => 'テストタイトル',
            'sales_abstract' => 'テスト概要',
            'category_id' => $category->id,
            'budget' => 1000,
            'schedule' => '2021-01-01',
        ];

        // 作成したユーザで認証
        $response = $this->actingAs($user)->post('/my/sales/store', $formData);

        $response->assertStatus(302);
        $this->assertDatabaseHas('sales_orders', [
            'title' => $formData['title'],
            'sales_abstract' => $formData['sales_abstract'],
            'category_id' => $formData['category_id'],
            'budget' => $formData['budget'],
            'schedule' => $formData['schedule'],
        ]);

        $sales_order = $user->sales_orders()->first();

        $response = $this->actingAs($user)->get('/sales/show/' . $sales_order->id);

        $response->assertStatus(200);
    }

    // テストとしてothers/sales/indexにアクセス可能かどうかを確認
    public function test_others_sales_index(): void
    {
        // テスト用のユーザを作成
        $user = User::factory()->create();

        // 作成したユーザで認証
        $response = $this->actingAs($user)->get('/others/sales/index');

        $response->assertStatus(200);
    }

    // テストとしてothers/sales/searchにアクセス可能かどうかを確認
    public function test_others_sales_search(): void
    {
        // テスト用のユーザを作成
        $user = User::factory()->create();

        // 作成したユーザで認証
        $response = $this->actingAs($user)->get('/others/sales/search');

        $response->assertStatus(200);
    }
}
