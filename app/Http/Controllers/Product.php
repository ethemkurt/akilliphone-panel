<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;

class Product extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function test(Request $request ){
        $params = $request->input('where', []);
        $offset = $request->input('length', 10);
        $start = $request->input('start', 0);
        $page = ($start/$offset)+1;

        $data['product'] = \Instance::loadJson('product');
        $data['brand'] = \WebService::brands();
        $data['categories'] = \WebService::categoriess();
        $data['currency'] = \Instance::loadJson('productControl');
        $data['options'] = \WebService::options($page, $offset, $params);
        $data['colors'] =$data['options']['data'][0]['optionValues'];

        $data['categories'] = array_filter($data['categories'], function ($category) {
            return $category['parentId'] === null;
        });
        return view('Product.test', $data);
    }
    public function trendyol(Request $request ){
        $data['trendyol_categories'] = \TrendyolService::getCategories();
        return view('Product.trendyol', $data);
    }
    public function ciceksepeti(Request $request ){

        $ciceksepeti=$request->input('ciceksepeti');
        $ciceksepeti['productId']=(int)$ciceksepeti['productId'];
        $ciceksepeti['productImage']="";
        $ciceksepeti['variantId']=(int)$ciceksepeti['variantId'];
        $ciceksepeti['variantOptionId']=(int)$ciceksepeti['variantOptionId'];
        $ciceksepeti['tax']=(int)$ciceksepeti['tax'];
        $ciceksepeti['productPrice']=(double)$ciceksepeti['productPrice'];
        $ciceksepeti['marketplaceMinimumPrice']=(double)$ciceksepeti['marketplaceMinimumPrice'];
        $ciceksepeti['minimumCompetitorPrice']=(double)$ciceksepeti['minimumCompetitorPrice'];
        $ciceksepeti['marketplacePriceDropRate']=(double)$ciceksepeti['marketplacePriceDropRate'];
        $ciceksepeti['criticalStockCount']=(int)$ciceksepeti['criticalStockCount'];
        $ciceksepeti['commission']=(double)$ciceksepeti['commission'];
        $ciceksepeti['shouldMultipleNamesBeOptions']=false;
        $ciceksepeti['published']=false;
        $ciceksepeti['deleted']=false;
        $ciceksepeti['deleted']=false;
        $ciceksepeti['oemCode']=null;
        return view('Product.new');
    }
    public function addCiceksepeti(Request $request,$productId ){
        return redirect(route('product.new'));
    }
    public function n11(Request $request ){
        $data['n11_categories'] = \N11Service::getCategories();

        return view('Product.n11', $data);
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

    public function category(Request $request ){
        $data['categoryId'] = $request->input('categoryId', 0);
        $data['trendyol_categories'] = \WebService::category($data['categoryId'] );

        return view('Trendyol.category', $data);
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
        $data['ciceksepeti_categories'] = \CiceksepetiService::getCategories();

        $params = $request->input('where', []);
        $offset = $request->input('length', 10);
        $start = $request->input('start', 0);
        $page = ($start/$offset)+1;
        $response = \WebService::options($page, $offset, $params);

        if($productId){
            if($productId=='new'){
                $data['product'] = \Instance::loadJson('product');
            } else{
                $data['product'] = \WebService::product($productId);

                $data['variants'] = \WebService::variant($data['product']['variants'][0]['variantId']);
            }
        } else{
            $data['product'] = [];
        }
        $data['currency'] = \Instance::loadJson('productControl');
        $data['options'] = \WebService::options($page, $offset, $params);

        $data['colors'] =$data['options']['data'][0]['optionValues'];

        $data['brand'] = \WebService::brands();
        $data['categories'] = \WebService::categoriess();
        $data['categories'] = array_filter($data['categories'], function ($category) {
            return $category['parentId'] === null;
        });

        return view('Product.new', $data);
    }
    public function addProduct(Request $request,$productId ){
        $product = $request->input('product', []);
        $product['slug'] = $formattedString = strtolower(str_replace(' ', '_', $product['name']));
        if ($product['metaTitle']==null) {
            $product['metaTitle'] = $product['name'];
        }
        if($imageFile = $request->input('featuredImage')){
            $product['featuredImage'] = \CdnService::saveToCdn($imageFile);
        }
        dd($product);
        $response = \WebService::addProduct($product);

        if(isset($response['data'])&& $response['data']){
            $productId=$response['data']['productId'];
            return _ReturnSucces("Ürün Başarıyla Oluşturuldu.",$productId);
        }
        return _ReturnError("Ürün Oluşturulamadı");
    }

    public function addCategories(Request $request){
        $response = \WebService::variant(20480);
        dd($response);




        $productCategories = $request->input('productCategories', []);
        $productId= $request->input('productId', []);
        $body=[];
        $response=null;
        if ($productCategories){
            foreach ($productCategories as $cat){
                $body['categoryId']=$cat;
                $body['productId']=$productId;
                $response = \WebService::addProductCategories($body);
            }
        }
        if(isset($response['errors'])&& $response['errors']==[]){

            return _ReturnSucces("Ürün Kategorileri Eklendi.",$productId);
        }
        return _ReturnError("Ürün Oluşturulamadı");
    }
    public function addStock(Request $request){



        $variants = $request->input('variants', []);

        $body=[];
        $productId=$request->input('productId', []);

        $product = \WebService::product(10494);
        $response=[];
        foreach ($variants as $variant){

            $variant["productId"]=10494;
            $variant["name"]=$product['name'];
            $variant["code"]=$product['code']."-".$variant["variantOptions"][0]["optionValueId"];
            $variant["slug"]=$product['slug'];
            $variant["description"]=$product['description'];
            $variant["metaTitle"]=$product['metaTitle'];
            $variant["metaDescription"]=$product['metaDescription'];
            if($imageFile = $variant['variantImages']['image']){
                $variant['featuredImage'] = \CdnService::saveToCdn($imageFile);

            }
            $variant["variantOptions"][0]["optionId"]=1;
            $variant["variantOptions"][0]["optionValueId"]=intval($variant["variantOptions"][0]["optionValueId"]);
            $variant["variantOptions"][0]["stock"]=intval($variant["variantOptions"][0]["stock"]);
            unset($variant["variantImages"]);

            $response = \WebService::addVariants($variant);

        }
        $product = \WebService::product(10494);
        $variantt = \WebService::variant(20485);

        if(isset($response['errors'])&& $response['errors']==[]){

            return _ReturnSucces("Ürün Stokları Eklendi.",$product);
        }
        return _ReturnError("Ürün Oluşturulamadı");

    }
    public function variant($productId){
        $colorsJson = \WebService::static('options/colors', []);
        $colors=$colorsJson['data'][0]['optionValues'];

        $response = \WebService::product(10494);
        $variantIds=[];
        $optionIds=[];
        if($response !=[]){

                foreach($response['variants'] as $variants){

                    if (!empty($variants['variantOptions']) ) {
                        if (isset($variants['variantOptions'])){

                            foreach ($colors as $color) {

                                if ($color['optionValueId']==$variants['variantOptions'][0]['optionValueId']){

                                    $newOption = ['optionValueId' => $variants['variantOptions'][0]['optionValueId'],'variantOptionId' => $variants['variantOptions'][0]['variantOptionId'],'colorName'=>$color['value']];
                                    $optionIds[] = $newOption;
                                }

                            }
                        }

                }


                }

                return _ReturnSucces("Ürün Başarıyla Oluşturuldu.",$optionIds);
        }
        return _ReturnError("Ürün Oluşturulamadı");
    }





    public function dataTable(Request $request){
        $dataTable = $this->dataTableParams();
        $filter['offset'] = $request->input('length', 10);
        $filter['start'] = $request->input('start', 0);
        $filter['page'] = ceil($filter['start']/$filter['offset']);
        $filter['active'] = 'all';
        $where = $request->input('where', []);

        if(isset($where)){
            if(isset($where['search_name']) && $where['search_name']){
                $filter['text'] = $where['search_name'];
            }
            if(isset($where['brandId']) && $where['brandId']){
                $filter['brand'] = $where['brandId'];
            }
            if(isset($where['categoryId']) && $where['categoryId']){
                $filter['cat'] = $where['categoryId'];
            }
            if(isset($where['active']) && $where['active']=='on'){
                $filter['active'] = 'active';
            }
            if(isset($where['passive']) && $where['passive']=='on' ){
                $filter['active'] = 'passive';
            }
            if(isset($where['active']) && $where['active']=='on' && isset($where['passive']) && $where['passive']=='on' ){
                $filter['active'] = 'all';
            }
        }
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
        $data = \request()->all();
        $data['brands'] = \WebService::brands();
        $data['categories'] = \WebService::categories();

        $dataTable->setFiters('Product.datatable-filter',$data );
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
