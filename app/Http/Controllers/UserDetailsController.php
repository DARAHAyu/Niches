<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;   
use App\Http\Requests\UserDetailsRequest;

use App\Models\User;    
use App\Models\UserDetail;

class UserDetailsController extends Controller
{
    // プロフィールのトップページ
    public function index()
    {
        $user = Auth::user();

        $latestUserDetail = $user->user_details()->latest()->first();
        
        return view('details.index', [
            'user' => $user,
            'latestUserDetail' => $latestUserDetail
        ]);
    }

    public function store(UserDetailsRequest $request)
    {
        $user = Auth::user();

        // 認証済みユーザの発注として作成（リクエストされた値を元に作成）
        $userDetail = $request->user()->user_details()->create([
            'nickname' => $request->nickname, 
            'age' => $request->age,
            'occupation' => $request->occupation,
            'business_area' => $request->business_area,
        ]);

        // 前のURLへリダイレクトさせる
        return view('details.index', [
            'latestUserDetail' => $userDetail,
            'user' => $user
        ]);
    }

    public function edit()
    {
        $user = Auth::user();

        $latestUserDetail = $user->user_details()->latest()->first();

        $this->authorize('edit', $latestUserDetail);

        return view('details.edit', [
            'user' => $user,
            'latestUserDetail' => $latestUserDetail
        ]);
    }

    public function update(UserDetailsRequest $request)
    {
        $user = Auth::user();

        // 認証済みユーザの発注として作成（リクエストされた値を元に作成）
        $request->user()->user_details()->latest()->first()->update([
            'nickname' => $request->nickname, 
            'age' => $request->age,
            'occupation' => $request->occupation,
            'business_area' => $request->business_area,
        ]);

        $latestUserDetail = $user->user_details()->latest()->first();

        $this->authorize('update', $latestUserDetail);

        // 前のURLへリダイレクトさせる
        return view('details.index', [
            'user' => $user,
            'latestUserDetail' => $latestUserDetail,
        ]);
    }

    public function details_index()
    {
        $user = Auth::user();

        $latestUserDetail = Auth::user()->user_details()->latest()->first();

        return view('details.show', [
            'user' => $user,
            'latestUserDetail' => $latestUserDetail,
        ]);
    }
}
