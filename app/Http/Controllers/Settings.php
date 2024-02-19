<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;

class Settings extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function index(Request $request ){
        return $this->general($request, 'general');
    }
    public function general(Request $request, $group='general' ){
        $data['group'] = $group;
        return view('Settings.index', $data);
    }
    public function enum(Request $request ){
        $data = [];
        return view('Settings.enum', $data);
    }
}
