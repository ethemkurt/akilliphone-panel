<?php

namespace App\Http\Controllers;

use App\Models\FailedLogs;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;

class AttributeValue extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function index(Request $request, $attributeId ){
        $response = \WebService::attribute($attributeId);

        if($response && isset($response['attributeId'])){
            $data['attribute'] = $response;
        } else{
            $data['attribute'] = \Instance::loadJson('attribute');
        }
        $data['dataTable'] = $this->dataTableParams($attributeId);
        return view('AttributeValue.index', $data);
    }
    public function edit(Request $request, $attributeId, $attributeValueId ){
            if($attributeValueId=='new'){
                $data['attributeValue'] = \Instance::loadJson('attributeValue');
                $data['attributeValue']['attributeId'] = $attributeId;
            } else{
                $data['attributeValue'] = \WebService::attributeValue($attributeValueId);
            }
        $html = view('AttributeValue.attributeValue-edit', $data)->render();
        return _ReturnSucces('', $html);
    }
    public function save(Request $request, $attributeId, $attributeValueId ){
        $attributeValue = $request->input('attributeValue');
        if($attributeValue){
            if($attributeValueId=='new'){
                $response = \WebService::attributeValueNew( $attributeValue);
            } else{
                $response = \WebService::attributeValueEdit($attributeValueId, $attributeValue);
            }

            if($response){
                if(isset($response['data']) && isset($response['data']['attributeValueId'])){
                    $result = 'Özellik kaydedildi';
                } else{
                    $result = 'Özellik kaydedilemedi';
                }
            } else {
                $result = 'Webservis sonucu alınmadı';
            }
        } else {
            $result = 'Özellik bilgilerini eksik veya hatalı gönderdiniz';
        }
        return _ReturnSucces('', $result);
    }
    public function deleteForm(Request $request, $attributeValueId ){

        if($attributeValueId){
            $data['attributeValue'] = \WebService::attributeValue($attributeValueId);
        } else{
            $data['attributeValue'] = [];
        }
        $html = view('AttributeValue.attributeValue-delete', $data)->render();
        return _ReturnSucces('', $html);
    }

    public function delete(Request $request, $attributeValueId ){
        $response = \WebService::attributeValue($attributeValueId);

        if($response && isset($response['attributeValueId'])){
            $response = \WebService::attributeValueDelete($attributeValueId);
            if($response){
                if( $response && isset($response['data'])){
                    $result = 'Yorum Silindi';
                } else{
                    $result = 'Yorum Silinemedi';
                }
            } else {
                $result = 'Webservis sonucu alınmadı';
            }
        } else{
            $result = 'Yorum bilgilerini eksik veya hatalı gönderdiniz';
        }
        return _ReturnSucces('', $result);
    }

    public function dataTable(Request $request, $attributeId){
        $dataTable = $this->dataTableParams($attributeId);
        $params = $request->input('where', []);

        $offset = $request->input('length', 10);
        $start = $request->input('start', 0);
        $page = ($start/$offset)+1;

        $response = \WebService::attribute($attributeId);

        $dataTable->setRecordsTotal(isset($response['totalCount'])?$response['totalCount']:0);
        $dataTable->setRecordsFiltered(isset($response['totalCount'])?$response['totalCount']:0);

        $items = [];

        if($response && isset($response['attributeValues'])){
            foreach($response['attributeValues'] as $row){

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
    private function dataTableParams($attributeId){
        $dataTable = new \AjaxDataTable();
        $dataTable->setTableId('attributeValue-list');
        $dataTable->setUrl(route('attribute.value.data-table', $attributeId));
        $dataTable->setRecordsTotal(100);
        $dataTable->setRecordsFiltered(90);
        $dataTable->setCols([
            'orderNumber'=>['title'=>'', 'className'=>'sort-order', 'orderable'=>''],
            'code'=>['title'=>'', 'className'=>'', 'orderable'=>''],
            'value'=>['title'=>'Özellik', 'className'=>'', 'orderable'=>''],
            'actions'=>['title'=>'', 'className'=>'action-buttons', 'orderable'=>''],
        ]);
        return $dataTable;
    }

    private function _format_actions($row){
        return '<a class="btn-popup-form btn waves-effect p-0 ms-1" data-url="'.route('attribute.value.edit', [$row['attributeId'], $row['attributeValueId']]).'"><i class="feather icon-file-text"></i></a> <a class="btn-popup-form btn waves-effect p-0 ms-1" data-url="'.route('attribute.value.delete.form',[ $row['attributeId'], $row['attributeValueId']]).'"><i class="feather icon-trash text-danger"></i></a>';
    }
}
