<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function sales_orders()
    {
        return $this->hasMany(SalesOrder::class);
    }

    public function purchase_orders()
    {
        return $this->hasMany(PurchaseOrder::class);
    }

    public function user_details()
    {
        return $this->hasOne(UserDetail::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function loadRelationshipCounts()
    {
        $this->loadCount('sales_orders', 'purchase_orders');
    }

    public function followings()
    {
        return $this->belongsToMany(User::class, 'user_follow', 'user_id', 'follow_id');
    }

    public function followers()
    {
        return $this->belongsToMany(User::class, 'user_follow', 'follow_id', 'user_id');
    }

    public function follow($userId)
    {
        $exist = $this->is_following($userId);
        $its_me = $this->id == $userId;

        if ($exist || $its_me) {
            return false;
        } else {
            $this->followings()->attach($userId);
            return true;
        }
    }

    public function unfollow($userId)
    {
        $exist = $this->is_following($userId);
        $its_me = $this->id == $userId;

        if ($exist && !$its_me) {
            $this->followings()->detach($userId);
            return true;
        } else {
            return false;
        }
    }

    public function is_following($userId)
    {
        return $this->followings()->where('follow_id', $userId)->exists();
    }

    public function message_rooms()
    {
        return $this->belongsToMany(MessageRoom::class, 'message_room_user', 'user_id', 'message_room_id')->withTimestamps();
    }

    // プロフィールを登録しているかどうかを調べる
    public function hasProfileDetails()
    {
        return $this->user_details()->exists();
    }

    public function create_message_room($senderId, $receiverId)
    {
        // 送信者と受信者の両方が参加している既存のメッセージルームを検索
        $messageRoom = MessageRoom::whereHas('users', function ($query) use ($senderId) {
            $query->where('user_id', $senderId);
        })->whereHas('users', function ($query) use ($receiverId) {
            $query->where('user_id', $receiverId);
        })->first();

        // 両者が同じidのメッセージルームに割り当てられていない場合は、新しく作成
        if (!$messageRoom) {
            $messageRoom = new MessageRoom();
            $messageRoom->save();

            // メッセージルームにユーザを関連付ける
            $messageRoom->users()->attach([$senderId, $receiverId]);
        }

        return $messageRoom;
    }
}
