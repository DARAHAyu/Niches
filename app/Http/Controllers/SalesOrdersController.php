<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 

use App\Models\SalesOrder;
use App\Models\User;

class SalesOrdersController extends Controller
{
    // 自分が作成した依頼を表示
    public function index()
    { 
        $user = Auth::user();

        $mySales = $user->sales_orders()->orderBy('created_at', 'desc')->paginate(10);

        return view('sales.index', [
            'user' => $user,
            'mySales' => $mySales,
        ]);
    }

    public function create()
    {
        $user = Auth::user();

        return view('sales.create', [
            'user' => $user,
        ]);
    }
    
    public function store(Request $request)
    {
        // バリデーション
        $request->validate([
            'title' => 'required|max:2000',
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
        $sales_order = SalesOrder::findOrFail($id);

        // 認証済みユーザがその投稿の所有者である場合は投稿を削除
        if (Auth::id() === $sales_order->user_id) {
            $sales_order->delete();
            return back()
                ->with('発注は削除されました');
        }

        // 前のURLへリダイレクトさせる
        return back()
            ->with('削除に失敗しました');
    }

    public function show($saleId) 
    {
        $sale = SalesOrder::findOrFail($saleId);

        return view('sales.show', [
            'sale' => $sale,
        ]);

    }
    
    // 自分以外の全ユーザの依頼を表示。
    public function othersSales()
    {
        $user = Auth::user();

        $othersSales = SalesOrder::where('user_id', '!=', Auth::id())->orderBy('created_at', 'desc')->paginate(10);

        return view('sales.others_sales', [
            'user' => $user,
            'othersSales' => $othersSales,
        ]);
    }
}
