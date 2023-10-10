<?php

use App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Route;


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
Route::get('/login', [Auth::class, 'login'])->name('login');
Route::post('/check-user', [Auth::class, 'checkUser'])->name('check-user');

Route::group(['prefix'=>'profile','as'=>'profile.', 'middleware' => ['check.token']], function () {
    Route::get('/', function (){ echo "sdeebene";})->name('index');
});

