<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;   

use App\Models\Message; 
use App\Models\User;
use App\Models\MessageRoom;

class MessageRoomsController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $message_rooms = $user->message_rooms;

        $messageRoomsData = $message_rooms->map(function ($message_room) use ($user)
         {
            $recipient = $message_room->users->firstWhere('id', '!=', $user->id);
            $lastMessage = $message_room->messages->sortByDesc('created_at')->first();

            return [
                'recipient' => $recipient,
                'lastMessage' => $lastMessage,
            ];
        });

        return view('message_rooms.index', [
            'user' => $user,
            'message_rooms' => $message_rooms,
            'messageRoomsData' => $messageRoomsData,
        ]);
    }
}
