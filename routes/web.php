<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UsersController;
use App\Http\Controllers\SalesOrdersController;
use App\Http\Controllers\PurchaseOrdersController;
use App\Http\Controllers\UserDetailsController;

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
    Route::get('my/sales/index/{id}', [SalesOrdersController::class, 'index'])->name('my-sales');
    Route::get('my/sales/create/{id}', [SalesOrdersController::class, 'create'])->name('sales-create');
    Route::post('my/sales/store', [SalesOrdersController::class, 'store'])->name('sales-store');
    Route::get('sales/show/{userId}/{saleId}', [SalesOrdersController::class, 'show'])->name('sales-show');
});

// 提案に関するページ
Route::group(['middleware' => ['auth']], function() {
    Route::get('my/purchase/index/{id}', [PurchaseOrdersController::class, 'index'])->name('my-purchase');
    Route::get('my/purchase/create/{id}', [PurchaseOrdersController::class, 'create'])->name('purchase-create');
    ROute::post('my/purchase/store', [PurchaseOrdersController::class, 'store'])->name('purchase-store');
});

// 「仕事を受注する」ページ
Route::get('purchase_orders_page', [PurchaseOrdersController::class, 'index'])->name('purchase-orders');

// 「提案を探す」ページ
Route::get('search/purchase', [PurchaseOrdersController::class, 'index2'])->name('search-purchase');

// 「プロフィール」ページ
Route::group(['middleware' => ['auth']], function() {
    Route::get('profile/index/{id}', [UserDetailsController::class, 'index'])->name("profile-index");
    Route::post('profile/store/{id}', [UserDetailsController::class, 'store'])->name("profile-store");
    Route::get('profile/edit/{id}', [UserDetailsController::class, 'edit'])->name("profile-edit");
    Route::put('profile/update/{id}', [UserDetailsController::class, 'update'])->name("profile-update");
});
