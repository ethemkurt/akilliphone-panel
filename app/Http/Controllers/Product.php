<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;

class Product extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function trendyol(Request $request ){
        $data['trendyol_categories'] = \TrendyolService::getCategories();
        return view('Product.trendyol', $data);
    }
    public function ciceksepeti(Request $request ){
        $data['ciceksepeti_categories'] = \CiceksepetiService::getCategories();
        return view('Product.ciceksepeti', $data);
    }
    public function kategori(Request $request ){
        $response = \WebService::categories();
        if(isset( $response['items'])){
            $data['categories'] = $response['items'];
        } else {
            $data['categories'] = [];
        }
        return view('Product.kategori', $data);
    }
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
    public function addProduct(Request $request ){
       $product['slug']="deneme";
       $product['metaTitle']="deneme";
       $product['description']="deneme";
       $product['featuredImage']="deneme";
       $product['discountRate']=0;
       $product['code']=0123123;
       $product['sessionalDiscountStart']="2024-02-29T18:10:43.425Z";
       $product['sessionalDiscountRate']=0;
       $product['sessionalDiscountEnd']="2024-02-29T18:10:43.425Z";
       $product['status']=0;
       $product['canGiftWrap']=true;
       $product['giftWrapPrice']=0;
//       $product['productTypeId']=6;
       $product['brandId']=6;
       $product['specialNote']="2asd12";
        if ($product!=[]){
            $data['product'] = \WebService::addProduct($product);


        }







        return redirect('Product.new');
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
                $product = \WebService::product($row['productId']);
                if($product){
                    $item = [];
                    foreach($dataTable->cols() as $key=>$col){
                        $method = '_format_'.$key;
                        if(method_exists($this, $method)){
                            $value = $this->$method($product);
                        } else {
                            $value = isset($row[$key])?$row[$key]:'';
                        }
                        $item[$key] = $value;

                    }
                    if(isset($item['orderNumber'])){
                        $item['orderNumber'] = count($items) + ($filter['offset']  * ($filter['page'])) + 1;
                    }
                    $items[] = $item;
                }
            }
        }
        $dataTable->setItems($items);
        return $dataTable->toJson();
    }
    private function _format_quaty($item) {
        return "--";
    }
    private function _format_sku($item) {
        return $item['code'];
    }
    private function _format_checkBox($item) {
        return '<input type="checkbox" class="form-check-input">';
    }
    private function _format_productCategories($item){
        if(isset($item['productCategories']) && $item['productCategories']){
            return '<span class="text-truncate d-flex align-items-center"><span class=" rounded-circle d-flex justify-content-center align-items-center me-2 "><img class="rounded-circle" src="'.getProductImageUrl($item['productCategories'][0]['category']['image'], 24, 24).'"></span>'.$item['productCategories'][0]['category']['name'].'</span>';
        }
    }
    private function _format_code($item){
        $html = '<a href="'.route('product.new', ['productId'=>$item['productId']]).'" >';
        return $html.$item['code'].'</a>';
    }
    private function _format_actions($item){
        $edit = route('product.new', ['productId'=>$item['productId']]);
        return '<div class="d-inline-block"><a class="btn btn-sm btn-icon" href="'.$edit.'"><i class="ti ti-edit"></i></a><button class="btn btn-sm btn-icon delete-record"><i class="ti ti-trash"></i></button><button class="btn btn-sm btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="ti ti-dots-vertical me-2"></i></button><div class="dropdown-menu dropdown-menu-end m-0"><a href="javascript:0;" class="dropdown-item">View</a><a href="javascript:0;" class="dropdown-item">Suspend</a></div></div>';

    }
    private function _format_price($item){
        if(isset($item['variants'][0])){
            return '<div class="text-end">'.$item['variants'][0]['price'].'₺</div>';
        }
    }
    private function _format_name($item){
        $parts = explode(' ', $item['name']);
        $names = array_chunk($parts, 4);
        return '<div class="d-flex justify-content-start align-items-center product-name"><div class="avatar-wrapper"><div class="  me-2 rounded-2 bg-label-secondary"><img src="'.getProductImageUrl($item['featuredImage'], 40, 40).'" alt="Product-9" class="rounded-2"></div></div><div class="d-flex flex-column"><h6 class="text-body text-nowrap mb-0">'.implode(' ', $names[0]).'</h6><small class="text-muted  d-none d-sm-block">'.$item['name'].'</small></div></div>';
    }
    private function _format_brandId($item){
        if(isset($item['brand']) && $item['brand']){
            return '<span class="text-truncate d-flex align-items-center"><span class="avatar-sm  d-flex justify-content-center align-items-center me-2 "><img class="" src="'.getProductImageUrl($item['brand']['image'], 45, 15).'"></span>'.$item['brand']['name'].'</span>';

        }
    }
    private function _format_featuredImage($item){
        $item['featuredImage'] = str_replace('img/', '', $item['featuredImage']);
        return '<img src="https://cdn.akilliphone.com/8004/30x30/'.$item['featuredImage'].'">';
    }
    private function _format_status($item){
        if($item['status']){
            return '<span class="badge bg-label-success" text-capitalized="">Aktif</span>';

        } else{
            return '<span class="badge bg-label-danger" text-capitalized="">Pasif</span>';

        }
    }
    private function dataTableParams(){
        $dataTable = new \AjaxDataTable();
        $dataTable->setTableId('product-list');
        $dataTable->setUrl(route('product.data-table'));
        $dataTable->setRecordsTotal(100);
        $dataTable->setRecordsFiltered(90);
        $dataTable->setCols([
            'checkBox'=>['title'=>'', 'className'=>'checkbox', 'orderable'=>''],
            //'code'=>['title'=>'Kodu', 'className'=>'', 'orderable'=>''],
            'name'=>['title'=>'Ürün Adı', 'className'=>'', 'orderable'=>''],
            'productCategories'=>['title'=>'Kategorisi', 'className'=>'', 'orderable'=>''],
            //'stock'=>['title'=>'Stok', 'className'=>'', 'orderable'=>''],
            'brandId'=>['title'=>'Marka', 'className'=>'', 'orderable'=>''],
            'sku'=>['title'=>'Kod', 'className'=>'', 'orderable'=>''],
            'price'=>['title'=>'Fiyat', 'className'=>'', 'orderable'=>''],
            'quaty'=>['title'=>'Adet', 'className'=>'', 'orderable'=>''],
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
