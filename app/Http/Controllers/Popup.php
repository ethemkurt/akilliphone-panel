<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;

class Popup extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function index(Request $request, $method ){
        if(method_exists($this, $method)){
            return $this->{$method}($request);
        }
    }
    public function OrderStatus(Request $request ){
        $data = [];
        $data['html'] = view('popup-forms.product-status', $data)->render();
        return returnSucces($data);
    }
}
