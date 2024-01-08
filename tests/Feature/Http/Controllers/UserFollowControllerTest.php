<?php

namespace Tests\Feature\Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\MessageRoom;
use App\Models\Message;

class UserFollowControllerTest extends TestCase
{
    use RefreshDatabase;

    // テストとしてmy/follow/{userId}にアクセスできるかどうかを確認
    public function test_UserFollow_store()
    {
        // テスト用のユーザを作成
        $user = User::factory()->create();
        // テスト用のフォローするユーザを作成
        $follow_user = User::factory()->create();

        // 作成したユーザでアクセス
        $response = $this->actingAs($user)->post('/my/follow/' . $follow_user->id);

        $response->assertStatus(302);
        $this->assertDatabaseHas('user_follow', [
            'user_id' => $user->id,
            'follow_id' => $follow_user->id,
        ]);
    }

    // テストとしてmy/unfollow/{userId}にアクセスできるかどうかを確認
    public function test_UserFollow_destroy()
    {
        // テスト用のユーザを作成
        $user = User::factory()->create();
        // テスト用のフォローするユーザを作成
        $follow_user = User::factory()->create();

        // 作成したユーザでアクセス (フォローする)
        $this->actingAs($user)->post('/my/follow/' . $follow_user->id);

        // 作成したユーザでアクセス (フォロー解除する)
        $response = $this->actingAs($user)->delete('/my/unfollow/' . $follow_user->id);

        $response->assertStatus(302);
        $this->assertDatabaseMissing('user_follow', [
            'user_id' => $user->id,
            'follow_id' => $follow_user->id,
        ]);
    }
}
