<?php

namespace App\Http\Controllers;

use App\Models\FailedLogs;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;

class OptionValue extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function index(Request $request, $optionId ){
        $response = \WebService::option($optionId);

        if($response && isset($response['optionId'])){
            $data['option'] = $response;
        } else{
            $data['option'] = \Instance::loadJson('option');
        }
        $data['dataTable'] = $this->dataTableParams($optionId);
        return view('OptionValue.index', $data);
    }
    public function edit(Request $request, $optionId, $optionValueId ){
            if($optionValueId=='new'){
                $data['optionValue'] = \Instance::loadJson('optionValue');
                $data['optionValue']['optionId'] = $optionId;
            } else{
                $data['optionValue'] = \WebService::optionValue($optionValueId);
            }
        $html = view('OptionValue.optionValue-edit', $data)->render();
        return _ReturnSucces('', $html);
    }
    public function save(Request $request, $optionId, $optionValueId ){
        $optionValue = $request->input('optionValue');
        if($optionValue){
            if($optionValueId=='new'){
                $response = \WebService::optionValueNew( $optionValue);
            } else{
                $response = \WebService::optionValueEdit($optionValueId, $optionValue);
            }
            if($response){
                if(isset($response['data']) && isset($response['data']['optionValueId'])){
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
    public function deleteForm(Request $request, $optionValueId ){

        if($optionValueId){
            $data['optionValue'] = \WebService::optionValue($optionValueId);
        } else{
            $data['optionValue'] = [];
        }
        $html = view('OptionValue.optionValue-delete', $data)->render();
        return _ReturnSucces('', $html);
    }

    public function delete(Request $request, $optionValueId ){
        $response = \WebService::optionValue($optionValueId);

        if($response && isset($response['optionValueId'])){
            $response = \WebService::optionValueDelete($optionValueId);
            if($response){
                if( $response && isset($response['data'])){
                    $result = 'Seçenek Silindi';
                } else{
                    $result = 'Seçenek Silinemedi';
                }
            } else {
                $result = 'Webservis sonucu alınmadı';
            }
        } else{
            $result = 'Seçenek bilgilerini eksik veya hatalı gönderdiniz';
        }
        return _ReturnSucces('', $result);
    }

    public function dataTable(Request $request, $optionId){
        $dataTable = $this->dataTableParams($optionId);
        $params = $request->input('where', []);

        $offset = $request->input('length', 10);
        $start = $request->input('start', 0);
        $page = ($start/$offset)+1;

        $response = \WebService::option($optionId);


        $items = [];
        if($response && isset($response['optionValues'])){
            $dataTable->setRecordsTotal(count($response['optionValues']));
            $dataTable->setRecordsFiltered(count($response['optionValues']));
            foreach($response['optionValues'] as $row){

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
        $parts = array_chunk($items, $offset);
        $items = $parts[$page-1];
        $dataTable->setItems($items);
        return $dataTable->toJson();

    }
    private function dataTableParams($optionId){
        $dataTable = new \AjaxDataTable();
        $dataTable->setTableId('optionValue-list');
        $dataTable->setUrl(route('option.value.data-table', $optionId));
        $dataTable->setRecordsTotal(0);
        $dataTable->setRecordsFiltered(0);
        $dataTable->setCols([
            'orderNumber'=>['title'=>'', 'className'=>'sort-order', 'orderable'=>''],
            'code'=>['title'=>'', 'className'=>'', 'orderable'=>''],
            'value'=>['title'=>'Özellik', 'className'=>'', 'orderable'=>''],
            'actions'=>['title'=>'', 'className'=>'action-buttons', 'orderable'=>''],
        ]);
        return $dataTable;
    }
    private function _format_actions($row){
        return '<a class="btn-popup-form btn waves-effect p-0 ms-1" data-url="'.route('option.value.edit',[ $row['optionId'], $row['optionValueId']]).'"><i class="menu-icon tf-icons ti ti-file-text"></i></a> <a class="btn-popup-form btn waves-effect p-0 ms-1" data-url="'.route('option.value.delete.form',[ $row['optionId'], $row['optionValueId']]).'"><i class="menu-icon tf-icons ti ti-trash"></i></a>';
    }
}
