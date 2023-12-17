<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;   
use App\Models\User;    
use App\Models\UserDetail;

class UserDetailsController extends Controller
{
    // プロフィールのトップページ
    public function index($id)
    {
        $user = User::findOrFail($id);

        $latestUserDetail = $user->user_details()->latest()->first();
        
        return view('details.index', [
            'user' => $user,
            'latestUserDetail' => $latestUserDetail
        ]);
    }

    /*
    public function show($id)
    {
        // idの値でユーザを検索して取得
        $user = User::findOrFail($id);
        
        // プロフィール詳細ビューでそれを表示
        return view('details.show', [
            'user' => $user,
        ]);
    }
    */

    public function store(Request $request)
    {
        // バリデーション
        $request->validate([
            'nickname' => 'required|max:30',
            'age' => 'required|max:3',
            'occupation' => 'required|max:30',
            'business_area' => 'required|max:30'
        ]);

        // 認証済みユーザの発注として作成（リクエストされた値を元に作成）
        $userDetail = $request->user()->user_details()->create([
            'nickname' => $request->nickname, 
            'age' => $request->age,
            'occupation' => $request->occupation,
            'business_area' => $request->business_area,
        ]);

        // 前のURLへリダイレクトさせる
        return view('details.index', [
            'userDetail' => $userDetail,
        ]);
    }
}
