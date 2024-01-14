<?php 

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use App\Models\Category;
use Tests\TestCase;

class PurchaseOrdersControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     *
     * @return void
     */

    // テストとしてmy/purchase/indexにアクセスできるかどうかを確認
    public function test_purchase_index(): void 
    {
        // テスト用のユーザを作成
        $user = User::factory()->create();

        // 作成したユーザでアクセス
        $response = $this->actingAs($user)->get('/my/purchase/index');

        $response->assertStatus(200);
    }

    // テストとしてmy/purchase/createにアクセスできるかどうかを確認
    public function test_purchase_create(): void
    {
        // テスト用のユーザを作成
        $user = User::factory()->create();

        // 作成したユーザでアクセス
        $response = $this->actingAs($user)->get('/my/purchase/create');

        $response->assertStatus(200);
    }

    // テストとしてmy/purchase/storeにアクセスできるかどうかを確認
    public function test_purchase_store(): void
    {
        // テスト用のユーザを作成
        $user = User::factory()->create();

        // テスト用のカテゴリーを作成
        $category = Category::factory()->create();

        // テスト用のフォームデータを作成
        $formData = [
            'title' => 'テストタイトル',
            'purchase_abstract' => 'テスト概要',
            'category_id' => $category->id,
            'budget' => 1000,
            'schedule' => '2021-01-01',
        ];

        // 作成したユーザでアクセス
        $response = $this->actingAs($user)->post('/my/purchase/store', $formData);

        $response->assertStatus(302);
        $this->assertDatabaseHas('purchase_orders', [
            'title' => $formData['title'],
            'purchase_abstract' => $formData['purchase_abstract'],
            'category_id' => $formData['category_id'],
            'budget' => $formData['budget'],
            'schedule' => $formData['schedule'],
        ]);
    }

    // テストとしてsales/destroy/{PurchaseId}にアクセスできるかどうかを確認
    public function test_purchase_destroy(): void
    {
        // テスト用のユーザを作成
        $user = User::factory()->create();

        // テスト用のカテゴリーを作成
        $category = Category::factory()->create();

        // テスト用のフォームデータを作成
        $formData = [
            'title' => 'テストタイトル',
            'purchase_abstract' => 'テスト概要',
            'category_id' => $category->id,
            'budget' => 1000,
            'schedule' => '2021-01-01',
        ];

        // 作成したユーザでフォームデータを保存
        $response = $this->actingAs($user)->post('/my/purchase/store', $formData);

        $response->assertStatus(302);
        $this->assertDatabaseHas('purchase_orders', [
            'title' => $formData['title'],
            'purchase_abstract' => $formData['purchase_abstract'],
            'category_id' => $formData['category_id'],
            'budget' => $formData['budget'],
            'schedule' => $formData['schedule'],
        ]);

        // 作成したフォームデータを取得
        $purchase_order = $user->purchase_orders()->first();

        // 作成したフォームデータを削除
        $response = $this->actingAs($user)->delete('/purchase/destroy/' . $purchase_order->id);

        $response->assertStatus(302);
        $this->assertDatabaseMissing('purchase_orders', [
            'title' => $formData['title'],
            'purchase_abstract' => $formData['purchase_abstract'],
            'category_id' => $formData['category_id'],
            'budget' => $formData['budget'],
            'schedule' => $formData['schedule'],
        ]);
    }

    // テストとしてpurchase/show/{purchaseId}にアクセスできるかどうかを確認
    public function test_purchase_show(): void
    {
        // テスト用のユーザを作成
        $user = User::factory()->create();

        // テスト用のカテゴリーを作成
        $category = Category::factory()->create();

        // テスト用のフォームデータを作成
        $formData = [
            'title' => 'テストタイトル',
            'purchase_abstract' => 'テスト概要',
            'category_id' => $category->id,
            'budget' => 1000,
            'schedule' => '2021-01-01',
        ];

        // 作成したユーザでフォームデータを保存
        $response = $this->actingAs($user)->post('/my/purchase/store', $formData);

        $response->assertStatus(302);
        $this->assertDatabaseHas('purchase_orders', [
            'title' => $formData['title'],
            'purchase_abstract' => $formData['purchase_abstract'],
            'category_id' => $formData['category_id'],
            'budget' => $formData['budget'],
            'schedule' => $formData['schedule'],
        ]);

        // 作成したフォームデータを取得
        $purchase_order = $user->purchase_orders()->first();

        // 作成したフォームデータを表示
        $response = $this->actingAs($user)->get('/purchase/show/' . $purchase_order->id);

        $response->assertStatus(200);
    }

    // テストとしてothers/purchases/indexにアクセスできるかどうかを確認
    public function test_others_purchase_index(): void
    {
        // テスト用のユーザを作成
        $user = User::factory()->create();

        // 作成したユーザでアクセス
        $response = $this->actingAs($user)->get('/others/purchases/index');

        $response->assertStatus(200);
    }

    // テストとしてothers/purchases/searchにアクセスできるかどうかを確認
    public function test_others_purchase_search(): void
    {
        // テスト用のユーザを作成
        $user = User::factory()->create();

        // 作成したユーザでアクセス
        $response = $this->actingAs($user)->get('/others/purchases/search');

        $response->assertStatus(200);
    }
}