<?php

use App\Http\Controllers\MessageRoomsController;
use App\Http\Controllers\MessagesController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UsersController;
use App\Http\Controllers\SalesOrdersController;
use App\Http\Controllers\PurchaseOrdersController;
use App\Http\Controllers\UserDetailsController;
use App\Http\Controllers\UserFollowController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/**
* Route::get('/', [SalesOrdersController::class, 'index']);
* Route::get('/dashboard', [SalesOrdersController::class, 'index'])->middleware(['auth'])->name('dashboard');
 */


Route::get('/', function () {
    return view('dashboard');
 });

Route::get('/dashboard', function () {
    return view('dashboard');
 })->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::group(['middleware' => ['auth']], function() {
    Route::resource('users', UsersController::class, ['only' => ['index', 'show']]);
    Route::resource('sales_orders', SalesOrdersController::class, ['only' => ['store', 'destroy']]);
    Route::resource('purchase_orders', PurchaseOrdersController::class, ['only' => ['store', 'destroy']]);
});

// 依頼に関するページ
Route::group(['middleware' => ['auth']], function() {
    Route::get('my/sales/index', [SalesOrdersController::class, 'index'])->name('my-sales');
    Route::get('my/sales/create', [SalesOrdersController::class, 'create'])->name('sales-create');
    Route::post('my/sales/store', [SalesOrdersController::class, 'store'])->name('sales-store');
    Route::get('sales/show/{saleId}', [SalesOrdersController::class, 'show'])->name('sales-show');
    // 「依頼を探す」ページ
    Route::get('others/sales/index', [SalesOrdersController::class, 'othersSales'])->name('others-sales');
});

// 提案に関するページ
Route::group(['middleware' => ['auth']], function() {
    Route::get('my/purchase/index', [PurchaseOrdersController::class, 'index'])->name('my-purchase');
    Route::get('my/purchase/create', [PurchaseOrdersController::class, 'create'])->name('purchase-create');
    Route::post('my/purchase/store', [PurchaseOrdersController::class, 'store'])->name('purchase-store');
    Route::get('purchase/show/{purchaseId}', [PurchaseOrdersController::class, 'show'])->name('purchase-show');
    // 「提案を探す」ページ
    Route::get('others/purchases/index', [PurchaseOrdersController::class, 'othersPurchases'])->name('others-purchases');
});

// 「プロフィール」ページ
Route::group(['middleware' => ['auth']], function() {
    Route::get('profile/index', [UserDetailsController::class, 'index'])->name("profile-index");
    Route::post('profile/store', [UserDetailsController::class, 'store'])->name("profile-store");
    Route::get('profile/edit', [UserDetailsController::class, 'edit'])->name("profile-edit");
    Route::put('profile/update', [UserDetailsController::class, 'update'])->name("profile-update");
    Route::get('profile/my/index', [UserDetailsController::class, 'details_index'])->name("details-index");
});

// 「メッセージ」ページ
Route::group(['middleware' => ['auth']], function() {
    Route::get('my/messages/create/{receiverId}', [MessagesController::class, 'create'])->name('messages-create');
    Route::post('my/messages/store/{messageRoomId}', [MessagesController::class, 'store'])->name('messages-store');
    Route::get('my/messages/index', [MessagesController::class, 'index'])->name('messages-index');
});

// MessageRoomモデル
Route::group(['middleware' => ['auth']], function() {
    Route::get('my/message-rooms/index', [MessageRoomsController::class, 'index'])->name('rooms-index');
});

// フォロー機能に関するモデル（userIdは相手のid）
Route::group(['middleware' => ['auth']], function () {
    Route::post('my/follow/{userId}', [UserFollowController::class, 'store'])->name('user-follow');
    Route::delete('my/unfollow/{userId}', [UserFollowController::class, 'destroy'])->name('user-unfollow');
    Route::get('followings', [UsersController::class, 'followings'])->name('user-followings');
    Route::get('followers', [UsersController::class, 'followers'])->name('user-followers');
});
