<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;   

use App\Models\Message; 
use App\Models\User;
use App\Models\MessageRoom;

class MessagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*
        $user = Auth::user();

        $message_rooms = $user->message_rooms;

        $messages = Auth::user()->messages()->get();

        $senders = $message_rooms->users()->where('user_id', '!=', $user->id)->get();

        return view('message_rooms.index', [
            'messages' => $messages,
            'user' => $user,
            'message_rooms' => $message_rooms,
        ]);
        */
    }

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
    public function store(Request $request, $messageRoomId)
    {
        
        $user = Auth::user();

        // バリデーション
        $request->validate([
            'message' => 'required|max:255',
        ]);

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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
