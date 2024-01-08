<?php

namespace Tests\Feature\Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class UsersControllerTest extends TestCase
{
    use RefreshDatabase;

    // テストとしてfollowingsにアクセスできるかどうかを確認
    public function test_Users_followings()
    {
        // テスト用のユーザを作成
        $user = User::factory()->create();

        // 作成したユーザでアクセス
        $response = $this->actingAs($user)->get('/followings');

        $response->assertStatus(200);
    }

    // テストとしてfollowersにアクセスできるかどうかを確認
    public function test_Users_followers()
    {
        // テスト用のユーザを作成
        $user = User::factory()->create();

        // 作成したユーザでアクセス
        $response = $this->actingAs($user)->get('/followers');

        $response->assertStatus(200);
    }
}
