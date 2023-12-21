<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 

use App\Models\PurchaseOrder;
use App\Models\User;

class PurchaseOrdersController extends Controller
{
    // 自分が作成した依頼を表示
    public function index()
    { 
        $user = Auth::user();

        $myPurchase = $user->purchase_orders()->orderBy('created_at', 'desc')->paginate(10);

        return view('purchase.index', [
            'user' => $user,
            'myPurchase' => $myPurchase,
        ]);
    }

    public function create()
    {
        $user = Auth::user();

        return view('purchase.create', [
            'user' => $user,
        ]);
    }

    public function store(Request $request)
    {
        // バリデーション
        $request->validate([
            'purchase_abstract' => 'required|max:2000',
            'title' => 'required|max:2000',
        ]);

        // 認証済みユーザの発注として作成（リクエストされた値を元に作成）
        $request->user()->purchase_orders()->create([
            'title' => $request->title, 
            'purchase_abstract' => $request->purchase_abstract,
        ]);

        // 前のURLへリダイレクトさせる
        return back();
    }

    public function destroy($id)
    {
        // idの値で発注を検索して取得
        $purchase_order = \App\Models\PurchaseOrder::findOrFail($id);

        // 認証済みユーザがその投稿の所有者である場合は投稿を削除
        if (Auth::id() === $purchase_order->user_id) {
            $purchase_order->delete();
            return back()
                ->with('発注は削除されました');
        }

        // 前のURLへリダイレクトさせる
        return back()
            ->with('削除に失敗しました');
    }

    public function show($purchaseId) 
    {
        $purchase = PurchaseOrder::findOrFail($purchaseId);

        return view('purchase.show', [
            'purchase' => $purchase,
        ]);

    }
    
    public function index2()
    {
        $data = [];

        if (Auth::check()) { // 認証済みの場合
        // 認証済みユーザを取得
        $user = Auth::user();
        
        // ユーザの投稿の一覧を作成日時の降順で取得
        // （後のChapterで他ユーザの投稿も取得するように変更するが、現時点ではこのユーザの投稿のみ取得する
        $purchase_orders = PurchaseOrder::where('user_id', '!=', auth()->user()->id)->orderBy('created_at', 'desc')->paginate(10);
        $data = [
            'user' => $user,
            'purchase_orders' => $purchase_orders,
        ];
        }

        return view('orders.search_purchase', $data);
        
    }

    public function othersPurchases() 
    {
        $user = Auth::user();

        $othersPurchases = PurchaseOrder::where('user_id', '!=', Auth::id())->orderBy('created_at', 'desc')->paginate(10);

        return view('purchase.others_purchases', [
            'user' => $user,
            'othersPurchases' => $othersPurchases,
        ]);
    }
}
