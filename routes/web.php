<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UsersController;
use App\Http\Controllers\SalesOrdersController;

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


// ダッシュボード再構成
Route::get('/', function () {
    return view('dashboard');
 });

Route::get('/dashboard', function () {
    return view('dashboard');
 })->middleware(['auth'])->name('dashboard');


// テキスト準拠
/*
Route::get('/', [SalesOrdersController::class, 'index']);
Route::get('/dashboard', [SalesOrdersController::class, 'index'])->middleware(['auth'])->name('dashboard');
*/

require __DIR__.'/auth.php';

Route::group(['middleware' => ['auth']], function() {
    Route::resource('users', UsersController::class, ['only' => ['index', 'show']]);
    Route::resource('sales_orders', SalesOrdersController::class, ['only' => ['store', 'destroy']]);
    // 元のルーティング
    // Route::resource('sales_orders', SalesOrdersController::class, ['only' => ['store', 'destroy']]);
});


Route::get('sales_orders_page', [SalesOrdersController::class, 'index'])->name('sales-orders');
