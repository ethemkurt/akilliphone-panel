<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;

class Ciceksepeti extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function index(Request $request, $brandId='parent' ){

    }
    public function category(Request $request ){
        $data['categoryId'] = $request->input('categoryId', 0);
        $data['ciceksepeti_categories'] = \CiceksepetiService::getCategories($data['categoryId'] );
        return view('Ciceksepeti.category', $data);
    }
}
