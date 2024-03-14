<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;

class N11 extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function index(Request $request, $brandId='parent' ){

    }
    public function category(Request $request ){
        $data['categoryId'] = $request->input('categoryId', 0);
        $data['n11_categories'] = \N11Service::getCategories($data['categoryId'] );
        return view('N11.category', $data);
    }
    public function productSpecs(Request $request){
        if($productId = $request->input('productId')){
            $data = [];
            $message = 'Ürün trendyol özellikleri';
            $html = view('Product.tabs.pazaryerleri.n11', $data)->render();
            return _ReturnSucces($message, $html);
        }
    }

}
