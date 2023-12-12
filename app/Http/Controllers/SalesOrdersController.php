<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\SalesOrder;

class SalesOrdersController extends Controller
{
    public function store(Request $request)
    {
        // バリデーション
        $request->validate([
            'sales_abstract' => 'required|max:2000',
        ]);

        // 認証済みユーザの発注として作成（リクエストされた値を元に作成）
        $request->user()->sales_orders()->create([
            'title' => $request->title, 
            'sales_abstract' => $request->sales_abstract,
        ]);

        // 前のURLへリダイレクトさせる
        return back();
    }

    public function destroy($id)
    {
        // idの値で発注を検索して取得
        $sales_order = \App\Models\SalesOrder::findOrFail($id);

        // 認証済みユーザがその投稿の所有者である場合は投稿を削除
        if (\Auth::id() === $sales_order->user_id) {
            $sales_order->delete();
            return back()
                ->with('発注は削除されました');
        }

        // 前のURLへリダイレクトさせる
        return back()
            ->with('削除に失敗しました');
    }
}
