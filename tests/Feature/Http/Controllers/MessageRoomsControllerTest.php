<?php

namespace Tests\Feature\Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\MessageRoom;
use App\Models\Message;

class MessageRoomsControllerTest extends TestCase
{
    use RefreshDatabase;

    // テストとしてmy/messages-rooms/indexにアクセスできるかどうかを確認
    public function test_MessageRooms_index()
    {
        // テスト用のユーザを作成
        $user = User::factory()->create();

        // 作成したユーザでアクセス
        $response = $this->actingAs($user)->get('/my/message-rooms/index');

        $response->assertStatus(200);
    }
}
