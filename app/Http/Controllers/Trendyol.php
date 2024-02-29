<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;

class Trendyol extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function index(Request $request, $brandId='parent' ){

    }
    public function category(Request $request ){
        $data['categoryId'] = $request->input('categoryId', 0);
        $data['trendyol_categories'] = \TrendyolService::getCategories($data['categoryId'] );
        return view('Trendyol.category', $data);
    }
}
