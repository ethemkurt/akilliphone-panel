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
    private function _format_action($item){
        return '<div class="dropdown">
             <button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0 waves-effect waves-float waves-light" data-bs-toggle="dropdown" aria-expanded="false">
              <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-vertical"><circle cx="12" cy="12" r="1"></circle><circle cx="12" cy="5" r="1"></circle><circle cx="12" cy="19" r="1"></circle></svg>
             </button>
             <div class="dropdown-menu dropdown-menu-end" style="">
              <a class="dropdown-item" href="#">
               <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 me-50"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg>
               <span>Düzenle</span>
              </a>
              <a class="dropdown-item" href="#">
               <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash me-50"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
               <span>Sil</span>
              </a>
             </div>
            </div>';
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
                $variant['featuredImage'] = str_replace('img/', '', $variant['featuredImage']);
                $html .='<div class="mr-1"><img src="https://cdn.akilliphone.com/8004/30x30/'.$variant['featuredImage'].'"></div>';
            }
        }
        return $item['name'].'<hr>'.$html.'</div>';
    }
    private function _format_featuredImage($item){
        $item['featuredImage'] = str_replace('img/', '', $item['featuredImage']);
        return '<img src="https://cdn.akilliphone.com/8004/30x30/'.$item['featuredImage'].'">';
    }
    private function _format_status($item){
        return '<span class="badge bg-'.\ActivePassive::color($item['status']).' me-1">'.\ActivePassive::__($item['status']).'</span>';
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
            'price'=>['title'=>'Fiyat', 'className'=>'', 'orderable'=>''],
            'action'=>['title'=>'', 'className'=>'', 'orderable'=>''],
        ]);
        return $dataTable;
    }

}
