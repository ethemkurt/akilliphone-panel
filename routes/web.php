<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth;
use App\Http\Controllers\Home;
use App\Http\Controllers\Order;


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
Route::get('/', [Home::class, 'notlogged']);
Route::get('/login', [Auth::class, 'login'])->name('login')->middleware(['non.registered']);
Route::post('/check-user', [Auth::class, 'checkUser'])->name('check-user')->middleware(['non.registered']);
Route::get('/logout', [Auth::class, 'logout'])->name('logout');

Route::group(['prefix'=>'home','as'=>'home.', 'middleware' => ['check.token']], function () {
    Route::get('/', [Home::class, 'index'])->name('index');
});
Route::group(['prefix'=>'order','as'=>'order.', 'middleware' => ['check.token']], function () {
    Route::get('/', [Order::class, 'index'])->name('index');
    Route::get('/detail/{orderId}', [Order::class, 'detail'])->name('detail');
    Route::get('/new', [Order::class, 'new'])->name('new');
});

