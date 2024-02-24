<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;

class Product extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function index(Request $request ){
        if($request->input('yedekle')){
            return $this->yedekle($request);
        }
        $data['dataTable'] = $this->dataTableParams();
        return view('Product.index', $data);
    }
    public function detail(Request $request, $productId ){
        $data['product'] = \WebService::product($productId);
        return view('Product.detail', $data);
    }
    public function new(Request $request,$productId ){

        if($productId){
            if($productId=='new'){
                $data['product'] = \Instance::loadJson('product');

            } else{

                $data['product'] = \WebService::product($productId);

            }
        } else{
            $data['product'] = [];
        }
        $data['currency'] = \Instance::loadJson('productControl');

        $data['brand'] = \WebService::brands();
        $data['categories'] = \WebService::categoriess();


        return view('Product.new', $data);
    }

   public function dataTable(Request $request){
    $dataTable = $this->dataTableParams();
    $filter['offset'] = $request->input('length', 10);
    $filter['start'] = $request->input('start', 0);
    $filter['page'] = ceil($filter['start']/$filter['offset']);
    $response = \WebService::products($filter);


    $dataTable->setRecordsTotal(isset($response['totalCount'])?$response['totalCount']:0);
    $dataTable->setRecordsFiltered(isset($response['totalCount'])?$response['totalCount']:0);
    $items = [];
    if($response && isset($response['items'])){

        foreach($response['items'] as $row){
            $item = [];
            foreach($dataTable->cols() as $key=>$col){
                $method = '_format_'.$key;
                if(method_exists($this, $method)){
                    $value = $this->$method($row);
                } else {
                    $value = isset($row[$key])?$row[$key]:'';
                }
                $item[$key] = $value;

                if ($key=="productCategories"){

                    $item[$key]=$value[0]["categoryId"];
                }

            }
            if(isset($item['orderNumber'])){
                $item['orderNumber'] = count($items) + ($filter['offset']  * ($filter['page'])) + 1;
            }
            if(isset($item['productCategories'])){


                $data = \WebService::category($item['productCategories']);
                $item['productCategories']=$data["name"];

            }
            $items[] = $item;

        }
    }

    $dataTable->setItems($items);
    return $dataTable->toJson();
}
    private function _format_code($item){

        $html = '<a href="'.route('product.new', ['productId'=>$item['productId']]).'" >';

        return $html.$item['code'].'</a>';

    }
    private function _format_actions($item){

        $edit = route('product.new', ['productId'=>$item['productId']]);
        return '<a class="btn waves-effect p-0 ms-1" data-url="'.$edit.'" title="\''.$item['name'].'\' düzenle" href="'.route('product.new', ['productId'=>$item['productId']]).'"><i class="feather icon-file-text"></i></a><a class="btn-popup-form btn waves-effect p-0 ms-1" data-url="#"><i class="feather icon-trash text-danger"></i></a>';

    }
    private function _format_price($item){
        if(isset($item['variants'][0])){
//            '.$item['variants'][0]['salePrice'].''.str_replace('USD', '$', $item['currency']).'<br>'
            return '<div class="text-end">'.$item['variants'][0]['price'].'₺</div>';
        }
    }
    private function _format_name($item){
        $html = '<a href="'.route('product.new', ['productId'=>$item['productId']]).'" ><div class="demo-inline-spacing" style="flex-wrap: nowrap;">';
        if($item['variants']){
            foreach ($item['variants'] as $variant){
                $html .='<div class="mr-1"><img src="'.getProductImageUrl($variant['featuredImage'], 60, 60).'"></div>';
            }
        }
        return $html.$item['name'].'</div></a>';
    }
    private function _format_brandId($item){
        $brand = \WebService::brand($item['brandId']);
        if($brand){
            return $brand['name'];
        }
    }
    private function _format_featuredImage($item){
        $item['featuredImage'] = str_replace('img/', '', $item['featuredImage']);
        return '<img src="https://cdn.akilliphone.com/8004/30x30/'.$item['featuredImage'].'">';
    }
    private function _format_status($item){
        return '<div class="d-flex flex-column">
            <div class="form-check form-check-success form-switch">
                <input type="checkbox" '.($item['status']?'checked':'').' class="form-check-input" id="customSwitch4">
            </div>
        </div>';
    }
    private function dataTableParams(){
        $dataTable = new \AjaxDataTable();
        $dataTable->setTableId('product-list');
        $dataTable->setUrl(route('product.data-table'));
        $dataTable->setRecordsTotal(100);
        $dataTable->setRecordsFiltered(90);
        $dataTable->setCols([
            'orderNumber'=>['title'=>'', 'className'=>'sort-order', 'orderable'=>''],
            'code'=>['title'=>'Kodu', 'className'=>'', 'orderable'=>''],
            'name'=>['title'=>'Ürün Adı', 'className'=>'', 'orderable'=>''],
            'productCategories'=>['title'=>'Kategorisi', 'className'=>'', 'orderable'=>''],
            'brandId'=>['title'=>'Marka', 'className'=>'', 'orderable'=>''],
            'price'=>['title'=>'Fiyat', 'className'=>'', 'orderable'=>''],
            'status'=>['title'=>'Durum', 'className'=>'', 'orderable'=>''],
            'actions'=>['title'=>'', 'className'=>'action-buttons', 'orderable'=>''],
        ]);
        return $dataTable;
    }
    private function yedekle(Request $request){
        $filter['page'] = $request->input('yedekle', 1);
        $filter['active']='all';
        $products = \WebService::products($filter);
        if(isset($products['items']) && $products['items']){
            foreach($products['items'] as $item){
                $product = \App\Models\Product::where(['productId' => $item['productId']])->first();
                if(empty($product)) {
                    $product = new \App\Models\Product();
                    $product->productId = $item['productId'];
                    $product->brandId = $item['brandId'];
                    $product->featuredImage = $item['featuredImage'];
                    $product->name = $item['name'];
                    $product->code = $item['code'];
                    $product->breadcrumb = $item['breadcrumb'];
                    $product->currency = $item['currency'];
                    //$product->description = $item['description'];
                    $product->slug = $item['slug'];
                    $product->metaTitle = $item['metaTitle'];
                    $product->metaDescription = $item['metaDescription'];
                    $product->discountRate = $item['discountRate'];
                    $product->sessionalDiscountRate = $item['sessionalDiscountRate'];
                    $product->sessionalDiscountStart = $item['sessionalDiscountStart'];
                    $product->sessionalDiscountEnd = $item['sessionalDiscountEnd'];
                    $product->status = $item['status'];
                    $product->save();
                    echo $item['code'].": ".$item['name']." (Eklendi)<br>";
                } else{
                    echo $item['code'].": ".$item['name']." (Zaten Var)<br>";
                }
            }
            return redirect(route('product.index', ['yedekle'=>$filter['page']+1, 'active'=>$filter['active']]));
        }
    }
}
