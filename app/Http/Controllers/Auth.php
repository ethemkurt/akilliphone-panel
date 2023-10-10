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
        return redirect( route('login'));
    }
    public function checkUser(Request $request ){
        $email = $request->input('email');
        $password = $request->input('password');
        $checkUser = \WebService::checkUser( $email, $password);
        if($checkUser['user']){
            \WebService::login($checkUser['user'], $checkUser['tokenData']);
            return redirect( route('home.index'));
        } else {
            $request->session()->flash('flash-error', ['Kullanıcı bulunmadı. Lütfen daha sonra tekrar deneyiniz', 'Giriş Yapılamadı']);
            return redirect()->back()->withInput();
        }
    }
}
