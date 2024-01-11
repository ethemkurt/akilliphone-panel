<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;

class Auth extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function login(Request $request ){
        $data = [];
        return view('Auth.login', $data);
    }
    public function logout(Request $request ){
        \WebService::logout();
        $request->session()->flash('flash-success', ['Çıkış işleminiz güvenli şekilde tamamlandı', 'Güle güle ']);
        return redirect( route('login'));
    }
    public function checkUser(Request $request ){
        $email = $request->input('email');
        $password = $request->input('password');
        $checkUser = \WebService::checkUser( $email, $password);

        if($checkUser['user']){
            \WebService::login($checkUser['user'], $checkUser['tokenData']);
            $request->session()->flash('flash-success', ['', 'Hoşgeldin. '.$checkUser['user']['fullName']]);
            return redirect( route('home.index'));
        } else {
            $error = isset($checkUser['error'])&&$checkUser['error']?$checkUser['error']:'Kullanıcı bulunmadı. Lütfen daha sonra tekrar deneyiniz';
            $request->session()->flash('flash-error', [$error, 'Giriş Yapılamadı']);
            return redirect()->back()->withInput();
        }
    }
}
