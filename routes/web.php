<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth;
use App\Http\Controllers\Home;
use App\Http\Controllers\Order;
use App\Http\Controllers\OrderStatus;
use App\Http\Controllers\PaymentStatus;
use App\Http\Controllers\PaymentType;
use App\Http\Controllers\User;
use App\Http\Controllers\Product;
use App\Http\Controllers\Popup;
use App\Http\Controllers\Settings;
use App\Http\Controllers\Slide;
use App\Http\Controllers\Logs;


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
    Route::post('/delete/{orderId}', [Order::class, 'delete'])->name('delete');
    Route::get('/barcode/{orderId}', [Order::class, 'barcode'])->name('barcode');
    Route::get('/data-table', [Order::class, 'dataTable'])->name('data-table');
    Route::get('/find-product-form', [Order::class, 'findProductForm'])->name('find-product-form');
    Route::get('/find-product-select2', [Order::class, 'findProductSelect2'])->name('find-product-select2');
    Route::post('/add-product-to-order', [Order::class, 'addProductToOrder'])->name('add-product-to-order');
    Route::get('/order-status', [OrderStatus::class, 'index'])->name('order-status');
    Route::get('/order-status/delete/{orderStatusId}', [OrderStatus::class, 'delete'])->name('order-status-delete');
    Route::post('/order-status', [OrderStatus::class, 'save'])->name('order-status-save');
    Route::get('/order-status-table', [OrderStatus::class, 'dataTable'])->name('order-status-table');
    Route::get('/payment-status', [PaymentStatus::class, 'index'])->name('payment-status');
    Route::get('/payment-status/delete/{paymentStatusId}', [PaymentStatus::class, 'delete'])->name('payment-status-delete');
    Route::post('/payment-status', [PaymentStatus::class, 'save'])->name('payment-status-save');
    Route::get('/payment-status-table', [PaymentStatus::class, 'dataTable'])->name('payment-status-table');
    Route::get('/payment-type', [PaymentType::class, 'index'])->name('payment-type');
    Route::get('/payment-type/delete/{paymentTypeId}', [PaymentType::class, 'delete'])->name('payment-type-delete');
    Route::post('/payment-type', [PaymentType::class, 'save'])->name('payment-type-save');
    Route::get('/payment-type-table', [PaymentType::class, 'dataTable'])->name('payment-type-table');
});
Route::group(['prefix'=>'user','as'=>'user.', 'middleware' => ['check.token']], function () {
    Route::get('/admin', [User::class, 'index'])->name('admin');
    Route::get('/bayi', [User::class, 'index'])->name('bayi');
    Route::get('/uye', [User::class, 'index'])->name('uye');
    Route::get('/detail/{userId}', [User::class, 'detail'])->name('detail');
    Route::get('/edit/{userId}', [User::class, 'edit'])->name('edit');
    Route::post('/edit/{userId}', [User::class, 'editUser'])->name('editUser');
    Route::post('/delete/{userId}', [User::class, 'delete'])->name('delete');
    Route::get('/data-table', [User::class, 'dataTable'])->name('data-table');
    Route::get('/find-user-form', [User::class, 'findUserForm'])->name('find-user-form');
    Route::get('/find-user-select2', [User::class, 'findUserSelect2'])->name('find-user-select2');
    Route::get('/get-user-data', [User::class, 'getUserData'])->name('get-user-data');
});
Route::group(['prefix'=>'product','as'=>'product.', 'middleware' => ['check.token']], function () {
    Route::get('/', [Product::class, 'index'])->name('index');
    Route::get('/detail/{productd}', [Product::class, 'detail'])->name('detail');
    Route::get('/new', [Product::class, 'new'])->name('new');
    Route::get('/data-table', [Product::class, 'dataTable'])->name('data-table');
});
Route::group(['prefix'=>'settings','as'=>'settings.', 'middleware' => ['check.token']], function () {
    Route::get('/', [Settings::class, 'index'])->name('index');
    Route::get('/enum', [Settings::class, 'enum'])->name('enum');

});
Route::group(['prefix'=>'slide','as'=>'slide.', 'middleware' => ['check.token']], function () {
    Route::get('/', [Slide::class, 'index'])->name('index');
    Route::get('/data-table', [Slide::class, 'dataTable'])->name('data-table');
    Route::get('/new', [Slide::class, 'new'])->name('new');
    Route::post('/new', [Slide::class, 'newOrder'])->name('newOrder');
    Route::get('/edit/{orderId}', [Slide::class, 'edit'])->name('edit');
    Route::post('/edit/{orderId}', [Slide::class, 'editSlide'])->name('editSlide');
    Route::get('/view/{orderId}', [Slide::class, 'view'])->name('view');
    Route::post('/delete/{orderId}', [Slide::class, 'delete'])->name('delete');
});
Route::group(['prefix'=>'logs','as'=>'logs.', 'middleware' => ['check.token']], function () {
    Route::get('/', [Logs::class, 'index'])->name('index');
    Route::get('/data-table', [Logs::class, 'dataTable'])->name('data-table');
    Route::get('/error', [Logs::class, 'error'])->name('error');
    Route::get('/error/{logId}', [Logs::class, 'errorView'])->name('error.view');
});



