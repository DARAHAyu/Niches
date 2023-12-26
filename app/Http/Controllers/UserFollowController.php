<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;   


class UserFollowController extends Controller
{
    public function store($userId)
    {
        // ログインユーザがuserIdのユーザをフォローする
        Auth::user()->follow($userId);

        // 前のURLへリダイレクトさせる
        return back();
    }

    public function destroy($userId)
    {
        // ログインユーザがuserIdのユーザをアンフォローする
        Auth::user()->unfollow($userId);

        // 前のURLへリダイレクトさせる
        return back();
    }
}
