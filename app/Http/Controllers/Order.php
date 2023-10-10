<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;

class Order extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function index(Request $request ){
        $data = [];
        return view('Orders.index', $data);
    }
    public function detail(Request $request, $orderId ){
        $data = [];
        return view('Orders.detail', $data);
    }
    public function new(Request $request ){
        $data = [];
        return view('Orders.new', $data);
    }
}
