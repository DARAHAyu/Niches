<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MessageRoomUser extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'message_room_id'];
}
