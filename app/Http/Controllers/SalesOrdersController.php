<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\SalesOrder;

class SalesOrdersController extends Controller
{
    public function index()
    {
        $data = [];
        if (\Auth::check()) { // 認証済みの場合
        // 認証済みユーザを取得
        $user = \Auth::user();
        // ユーザの投稿の一覧を作成日時の降順で取得
        // （後のChapterで他ユーザの投稿も取得するように変更するが、現時点ではこのユーザの投稿のみ取得する
        $sales_orders = $user->sales_orders()->orderBy('created_at', 'desc')->paginate(10);
        $data = [
            'user' => $user,
            'sales_orders' => $sales_orders,
        ];
        }

        // dashboardビューでそれらを表示
        return view('dashboard', $data);
    }

    public function store(Request $request)
    {
        // バリデーション
        $request->validate([
            'sales_abstract' => 'required|max:2000',
            'title' => 'required|max:2000',
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
