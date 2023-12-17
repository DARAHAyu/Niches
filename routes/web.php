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

// 「仕事を依頼する」ページ
Route::get('sales_orders_page', [SalesOrdersController::class, 'index'])->name('sales-orders');
// 「仕事を受注する」ページ
Route::get('purchase_orders_page', [PurchaseOrdersController::class, 'index'])->name('purchase-orders');
// 「依頼を探す」ページ
Route::get('search/sales', [SalesOrdersController::class, 'index2'])->name('search-sales');
// 「提案を探す」ページ
Route::get('search/purchase', [PurchaseOrdersController::class, 'index2'])->name('search-purchase');
// 「プロフィール」ページ
Route::get('profile/index/{id}', [UserDetailsController::class, 'index'])->name("profile-index");
Route::post('profile/store', [UserDetailsController::class, 'store'])->name("profile-store");
