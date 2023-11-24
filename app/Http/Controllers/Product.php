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
        $data['dataTable'] = $this->dataTableParams();
        return view('Product.index', $data);
    }
    public function detail(Request $request, $productId ){
        $data['product'] = \WebService::product($productId);
        return view('Product.detail', $data);
    }
    public function new(Request $request ){
        $data = [];
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
                }
                if(isset($item['orderNumber'])){
                    $item['orderNumber'] = count($items) + ($filter['offset']  * ($filter['page'])) + 1;
                }
                $items[] = $item;
            }
        }
        $dataTable->setItems($items);
        return $dataTable->toJson();
    }
    private function _format_actions($item){
        return '<div style="min-width: 40px;" class="text-end"><button type="button" class="btn btn-flat-primary waves-effect p-0 me-1"><i class="fa fa-edit"></i></button>
<button type="button" class="btn btn-flat-danger waves-effect p-0 me-1"><i class="fa fa-trash"></i></button></div>';
    }
    private function _format_price($item){
        if(isset($item['variants'][0])){
            return '<div class="text-end">'.$item['variants'][0]['salePrice'].''.str_replace('USD', '$', $item['currency']).'<br>'
            .$item['variants'][0]['price'].'₺</div>';
        }
    }
    private function _format_name($item){
        $html = '<div class="demo-inline-spacing">';
        if($item['variants']){
            foreach ($item['variants'] as $variant){
                $html .='<div class="mr-1"><img src="'.getProductImageUrl($variant['featuredImage'], 60, 60).'"></div>';
            }
        }
        return $item['name'].'<hr>'.$html.'</div>';
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
            'orderNumber'=>['title'=>'', 'className'=>'', 'orderable'=>''],
            'code'=>['title'=>'Kodu', 'className'=>'', 'orderable'=>''],
            'name'=>['title'=>'Ürün Adı', 'className'=>'', 'orderable'=>''],
            'productCategories'=>['title'=>'Kategorisi', 'className'=>'', 'orderable'=>''],
            'brandId'=>['title'=>'Marka', 'className'=>'', 'orderable'=>''],
            'price'=>['title'=>'Fiyat', 'className'=>'', 'orderable'=>''],
            'status'=>['title'=>'Durum', 'className'=>'', 'orderable'=>''],
            'actions'=>['title'=>'', 'className'=>'', 'orderable'=>''],
        ]);
        return $dataTable;
    }

}
