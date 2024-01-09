<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;   
use App\Http\Requests\MessagesRequest;

use App\Models\Message; 
use App\Models\User;
use App\Models\MessageRoom;

class MessagesController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($receiverId)
    {
        $sender = Auth::user();

        $receiver = User::findOrFail($receiverId);

        $message_room = $sender->create_message_room($sender->id, $receiver->id);

        $messages = $message_room->messages()->get();

        return view('messages.create', [
            'sender' => $sender,
            'receiver' => $receiver,
            'message_room' => $message_room,
            'messages' => $messages,
        ]); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MessagesRequest $request, $messageRoomId)
    {
        
        $user = Auth::user();

        $user->messages()->create([
            'message' => $request->message,
            'message_room_id' => $messageRoomId,
        ]);

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // idの値でメッセージを検索して取得
        $message = Message::findOrFail($id);

        // メッセージ詳細ビューでそれを表示
        return view('messages.show', [
            'message' => $message,
        ]);
    }
}
