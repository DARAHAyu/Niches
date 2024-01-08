<?php

namespace Tests\Feature\Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\User;
use App\Models\MessageRoom;
use App\Models\Message;

class MessagesControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test the index method of MessagesController.
     *
     * @return void
     */
    
    // my/messages/indexにアクセスできるかどうかを確認
    public function test_Messages_index()
    {
        // テスト用のユーザを作成
        $user = User::factory()->create();

        // 作成したユーザでアクセス
        $response = $this->actingAs($user)->get('/my/messages/index');

        $response->assertStatus(200);
    }

    // my/messages/createにアクセスできるかどうかを確認
    public function test_Messages_create()
    {
        // $senderを作成
        $sender = User::factory()->create();
        // $receiverを作成
        $receiver = User::factory()->create();

        // 作成したユーザでアクセス
        $response = $this->actingAs($sender)->get('/my/messages/create/' . $receiver->id);

        $response->assertStatus(200);
    }

    // my/messages/storeにアクセスできるかどうかを確認
    public function test_Messages_store()
    {
        // テストユーザを作成
        $user = User::factory()->create();
        // メッセージルームを作成
        $message_room = MessageRoom::factory()->create();

        // テスト用のフォームデータを作成
        $formData = [
            'message' => 'テストメッセージ',
        ];

        // 作成したユーザでアクセス
        $response = $this->actingAs($user)->post('/my/messages/store/' . $message_room->id, $formData);

        $response->assertStatus(302);
        $this->assertDatabaseHas('messages', [
            'message' => $formData['message'],
            'message_room_id' => $message_room->id,
            'user_id' => $user->id,
        ]);
    }
}
