<?php

namespace App\Http\Controllers;

use App\Models\FailedLogs;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;

class Attribute extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function index(Request $request ){
        $data['dataTable'] = $this->dataTableParams();
        return view('Attribute.index', $data);
    }
    public function edit(Request $request, $attributeId ){

        if($attributeId){
            $data['attribute'] = \WebService::attribute($attributeId);
        } else{
            $data['attribute'] = [];
        }
        $html = view('Attribute.attribute-edit', $data)->render();
        return _ReturnSucces('', $html);
    }
    public function save(Request $request, $attributeId ){
        $attribute = $request->input('attribute');
        if($attribute){
            $response = \WebService::attributeEdit($attributeId, $attribute);

            if($response){
                if(isset($response['data']) && isset($response['data']['attributeId'])){
                    $result = 'Ürün Özelliği kaydedildi';
                } else{
                    $result = 'Ürün Özelliği kaydedilemedi';
                }
            } else {
                $result = 'Webservis sonucu alınmadı';
            }
        } else {
            $result = 'Ürün Özelliği bilgilerini eksik veya hatalı gönderdiniz';
        }
        return _ReturnSucces('', $result);
    }
    public function deleteForm(Request $request, $attributeId ){

        if($attributeId){
            $data['attribute'] = \WebService::attribute($attributeId);
        } else{
            $data['attribute'] = [];
        }
        $html = view('Attribute.attribute-delete', $data)->render();
        return _ReturnSucces('', $html);
    }

    public function delete(Request $request, $attributeId ){
        $response = \WebService::attribute($attributeId);
        if($response && isset($response['attributeId'])){
            $response = \WebService::attributeDelete($attributeId);
            if($response){
                if( $response && isset($response['data'])){
                    $result = 'Ürün Özelliği Silindi';
                } else{
                    $result = 'Ürün Özelliği Silinemedi';
                }
            } else {
                $result = 'Webservis sonucu alınmadı';
            }
        } else{
            $result = 'Ürün Özelliği bilgilerini eksik veya hatalı gönderdiniz';
        }
        return _ReturnSucces('', $result);
    }

    public function dataTable(Request $request){
        $dataTable = $this->dataTableParams();
        $params = $request->input('where', []);
        $offset = $request->input('length', 10);
        $start = $request->input('start', 0);
        $page = ($start/$offset)+1;
        $response = \WebService::attributes($page, $offset, $params);

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
                    $item['orderNumber'] = count($items) + $start + 1;
                }
                $items[] = $item;
            }
        }
        $dataTable->setItems($items);
        return $dataTable->toJson();

    }
    private function dataTableParams(){
        $dataTable = new \AjaxDataTable();
        $dataTable->setTableId('attribute-list');
        $dataTable->setUrl(route('attribute.data-table'));
        $dataTable->setRecordsTotal(100);
        $dataTable->setRecordsFiltered(90);
        $dataTable->setCols([
            'orderNumber'=>['title'=>'', 'className'=>'sort-order', 'orderable'=>''],
            'product_image'=>['title'=>'', 'className'=>'', 'orderable'=>''],
            'product'=>['title'=>'Ürün', 'className'=>'', 'orderable'=>''],
            'attribute1'=>['title'=>'Ürün Özelliği', 'className'=>'', 'orderable'=>''],
            'status'=>['title'=>'Durumu', 'className'=>'', 'orderable'=>''],
            'created_at'=>['title'=>'Tarih', 'className'=>'', 'orderable'=>''],
            'actions'=>['title'=>'', 'className'=>'action-buttons', 'orderable'=>''],
        ]);
        $dataTable->setFiters('Attribute.datatable-filter', \request()->all());

        return $dataTable;
    }

    private function _format_created_at($row){
        return _HumanDate($row['createdAt'], 'm.d.Y');
    }
    private function _format_product_image($row){
        $featuredImage =  '<div class="avatar me-2"><img src="'.getProductImageUrl($row['product']['featuredImage'], 60, 60).'"></div><div class="mr-1">';
        return $featuredImage;
    }
    private function _format_product($row){
        return $row['product']['name'];
    }
    private function _format_customer($row){
        if($row['customer']){
            return $row['customer']['firstName'].' '.$row['customer']['lastName'];
        }
        return 'Misafir';
    }
    private function _format_attribute1($row){
        if($row['customer']){
            $customer = $row['customer']['firstName'].' '.$row['customer']['lastName'];
        } else {
            $customer = 'Misafir';
        }
        return '<strong class="badge rounded-pill badge-light-warning">'.$customer.'</strong> '.$row['attribute1'].'<hr><strong  class="badge rounded-pill badge-light-info">Cevap </strong>'.$row['answer'].'';
    }
    private function _format_rating($row){
        return $row['rating'];
    }
    private function _format_status($row){
        return '<span class="badge rounded-pill badge-light-'.\ActivePassive::color($row['status']).'" text-capitalized="">'.\ActivePassive::__($row['status']).'</span>';
    }

    private function _format_actions($row){
        return '<a class="btn-popup-form btn waves-effect p-0 ms-1" data-url="'.route('attribute.edit', $row['attributeId']).'"><i class="feather icon-file-text"></i></a> <a class="btn-popup-form btn waves-effect p-0 ms-1" data-url="'.route('attribute.delete.form', $row['attributeId']).'"><i class="feather icon-trash text-danger"></i></a>';
    }
}
