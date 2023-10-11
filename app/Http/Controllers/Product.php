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
        $offset = $request->input('length', 10);
        $start = $request->input('start', 0);
        $page = ($start/$offset)+1;
        $response = \WebService::products($page, $offset);
        $dataTable->setRecordsTotal($response['totalCount']);
        $dataTable->setRecordsFiltered($response['totalCount']);
        $items = [];
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
                $item['orderNumber'] = count($items) + $start + 1;
            }
            $items[] = $item;
        }
        $dataTable->setItems($items);
        return $dataTable->toJson();
    }
    private function _format_name($item){
        $html = '';
        if($item['variants']){
            foreach ($item['variants'] as $variant){
                $variant['featuredImage'] = str_replace('img/', '', $variant['featuredImage']);
                $html .='<img src="https://cdn.akilliphone.com/8004/30x30/'.$variant['featuredImage'].'"> ';
            }
        }
        return $item['name'].'<hr>'.$html;
    }
    private function _format_featuredImage($item){
        $item['featuredImage'] = str_replace('img/', '', $item['featuredImage']);
        return '<img src="https://cdn.akilliphone.com/8004/30x30/'.$item['featuredImage'].'">';
    }
    private function _format_status($item){
        return '<span class="badge rounded-pill badge-light-'.\ActivePassive::color($item['status']).'" text-capitalized="">'.\ActivePassive::__($item['status']).'</span>';
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
            'name'=>['title'=>'Ad', 'className'=>'', 'orderable'=>''],
            'status'=>['title'=>'Durum', 'className'=>'', 'orderable'=>''],
        ]);
        return $dataTable;
    }

}
