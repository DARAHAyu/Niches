<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\User;

class UserDetailsControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * ユーザーの詳細情報を取得するテスト
     *
     * @return void
     */

    // テストとしてprofile/indexにアクセスできるかどうかを確認
    public function test_UserDetails_index()
    {
        // ログインユーザを用意
        $user = User::factory()->create();

        // ログインユーザでアクセス
        $response = $this->actingAs($user)->get('profile/index');

        $response->assertStatus(200);
    }

    // テストとしてprofile/storeにアクセスできるかどうかを確認
    public function test_UserDetails_store()
    {
        // ログインユーザを用意
        $user = User::factory()->create();

        // テスト用のフォームデータを作成
        $formData = [
            'nickname' => 'テストニックネーム',
            'age' => 20,
            'occupation' => 'テスト職業',
            'business_area' => 'テスト営業エリア',
        ];

        // ログインユーザでフォームデータを送信
        $response = $this->actingAs($user)->post('profile/store', $formData);

        $response->assertStatus(200);
        $this->assertDatabaseHas('user_details', [
            'nickname' => $formData['nickname'],
            'age' => $formData['age'],
            'occupation' => $formData['occupation'],
            'business_area' => $formData['business_area'],
        ]);
    }

    // テストとしてprofile/editにアクセスできるかどうかを確認
    public function test_UserDetails_edit()
    {
        // ログインユーザを用意
        $user = User::factory()->create();

        // フォームデータを用意
        $formData = [
            'nickname' => 'テストニックネーム',
            'age' => 20,
            'occupation' => 'テスト職業',
            'business_area' => 'テスト営業エリア',
        ];

        // ログインユーザでフォームデータを送信
        $response = $this->actingAs($user)->post('profile/store', $formData);

        // ログインユーザでアクセス
        $response = $this->actingAs($user)->get('profile/edit');

        $response->assertStatus(200);
    }

    // テストとしてprofile/updateにアクセスできるかどうかを確認
    public function test_UserDetails_update()
    {
        // ログインユーザを用意
        $user = User::factory()->create();

        // フォームデータを用意
        $formData = [
            'nickname' => 'テストニックネーム',
            'age' => 20,
            'occupation' => 'テスト職業',
            'business_area' => 'テスト営業エリア',
        ];

        // ログインユーザでフォームデータを送信
        $response = $this->actingAs($user)->post('profile/store', $formData);

        // 更新用のフォームデータを用意
        $updateFormData = [
            'nickname' => 'テストニックネーム2',
            'age' => 30,
            'occupation' => 'テスト職業2',
            'business_area' => 'テスト営業エリア2',
        ];

        // ログインユーザで更新用のフォームデータを送信
        $response = $this->actingAs($user)->put('profile/update', $updateFormData);

        $response->assertStatus(200);
        $this->assertDatabaseHas('user_details', [
            'nickname' => $updateFormData['nickname'],
            'age' => $updateFormData['age'],
            'occupation' => $updateFormData['occupation'],
            'business_area' => $updateFormData['business_area'],
        ]);
    }

    // テストとしてprofile/my/indexにアクセスできるかどうかを確認
    public function test_UserDetails_my_index()
    {
        // ログインユーザを用意
        $user = User::factory()->create();

        // フォームデータを用意
        $formData = [
            'nickname' => 'テストニックネーム',
            'age' => 20,
            'occupation' => 'テスト職業',
            'business_area' => 'テスト営業エリア',
        ];

        // ログインユーザでフォームデータを送信
        $response = $this->actingAs($user)->post('profile/store', $formData);

        // ログインユーザでアクセス
        $response = $this->actingAs($user)->get('profile/my/index');

        $response->assertStatus(200);
        $this->assertDatabaseHas('user_details', [
            'nickname' => $formData['nickname'],
            'age' => $formData['age'],
            'occupation' => $formData['occupation'],
            'business_area' => $formData['business_area'],
        ]);
    }
}
