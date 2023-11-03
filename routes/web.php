<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth;
use App\Http\Controllers\Home;
use App\Http\Controllers\Order;
use App\Http\Controllers\OrderStatus;
use App\Http\Controllers\Customer;
use App\Http\Controllers\Product;
use App\Http\Controllers\Popup;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*
Route::get('html/{module?}/{action?}', function (string $module = 'home',string $action = null) {
    if($action == null ) return view('content.'.$module);
    return view('content.'.$module.'.'.$action);
});
*/
Route::get('/popup/{method}', [Popup::class, 'index'])->name('popup')->middleware(['check.token']);

Route::get('/', [Home::class, 'notlogged']);
Route::get('/login', [Auth::class, 'login'])->name('login')->middleware(['non.registered']);
Route::post('/check-user', [Auth::class, 'checkUser'])->name('check-user')->middleware(['non.registered']);
Route::get('/logout', [Auth::class, 'logout'])->name('logout');
Route::get('/enum', [\Enum::class, 'loadConst']);

Route::group(['prefix'=>'home','as'=>'home.', 'middleware' => ['check.token']], function () {
    Route::get('/', [Home::class, 'index'])->name('index');
});
Route::group(['prefix'=>'order','as'=>'order.', 'middleware' => ['check.token']], function () {
    Route::get('/', [Order::class, 'index'])->name('index');
    Route::get('/detail/{orderId}', [Order::class, 'detail'])->name('detail');
    Route::get('/new', [Order::class, 'new'])->name('new');
    Route::post('/new', [Order::class, 'newOrder'])->name('newOrder');
    Route::get('/edit/{orderId}', [Order::class, 'edit'])->name('edit');
    Route::post('/edit/{orderId}', [Order::class, 'editOrder'])->name('editOrder');
    Route::get('/view/{orderId}', [Order::class, 'view'])->name('view');
    Route::get('/delete/{orderId}', [Order::class, 'delete'])->name('delete');
    Route::get('/data-table', [Order::class, 'dataTable'])->name('data-table');
    Route::get('/order-status', [OrderStatus::class, 'index'])->name('status');
    Route::post('/order-status', [OrderStatus::class, 'Save'])->name('status-save');
    Route::get('/order-status-table', [OrderStatus::class, 'dataTable'])->name('status-table');
});
Route::group(['prefix'=>'customer','as'=>'customer.', 'middleware' => ['check.token']], function () {
    Route::get('/', [Customer::class, 'index'])->name('index');
    Route::get('/detail/{customerId}', [Customer::class, 'detail'])->name('detail');
    Route::get('/new', [Customer::class, 'new'])->name('new');
    Route::get('/data-table', [Customer::class, 'dataTable'])->name('data-table');
});
Route::group(['prefix'=>'product','as'=>'product.', 'middleware' => ['check.token']], function () {
    Route::get('/', [Product::class, 'index'])->name('index');
    Route::get('/detail/{productd}', [Product::class, 'detail'])->name('detail');
    Route::get('/new', [Product::class, 'new'])->name('new');
    Route::get('/data-table', [Product::class, 'dataTable'])->name('data-table');
});



