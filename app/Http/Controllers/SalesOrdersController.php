<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 

use App\Models\SalesOrder;
use App\Models\User;
use App\Models\Category;
use App\Http\Requests\SalesOrdersRequest;

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

        $categories = Category::all();

        return view('sales.create', [
            'user' => $user,
            'categories' => $categories,
        ]);
    }
    
    public function store(SalesOrdersRequest $request)
    {
        // 認証済みユーザの発注として作成（リクエストされた値を元に作成）
        $request->user()->sales_orders()->create([
            'title' => $request->title, 
            'sales_abstract' => $request->sales_abstract,
            'category_id' => $request->category_id,
            'budget' => $request->budget,
            'schedule' => $request->schedule,
        ]);

        // 前のURLへリダイレクトさせる
        return back();
    }

    public function destroy(Request $request, $id)
    {
        // idの値で発注を検索して取得
        $sales_order = SalesOrder::findOrFail($id);

        // 認証済みユーザがその投稿の所有者である場合は投稿を削除
        $sales_order->delete();

        return back()->with('発注は削除されました');
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
        $isSalesPage = true;

        $user = Auth::user();

        $othersSales = SalesOrder::where('user_id', '!=', Auth::id())->orderBy('created_at', 'desc')->paginate(10);

        return view('sales.others_sales', [
            'user' => $user,
            'othersSales' => $othersSales,
            'isSalesPage' => $isSalesPage,
        ]);
    }

    // 依頼をキーワードで検索
    public function search()
    {
        $isSalesPage = true;

        $user = Auth::user();

        $keyword = request('keyword');

        $othersSales = SalesOrder::where('user_id', '!=', Auth::id())->where('title', 'like', "%{$keyword}%")->orderBy('created_at', 'desc')->paginate(10);

        return view('sales.others_sales', [
            'user' => $user,
            'othersSales' => $othersSales,
            'isSalesPage' => $isSalesPage,
        ]);
    }
}
