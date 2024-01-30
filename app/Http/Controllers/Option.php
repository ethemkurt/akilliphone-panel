<?php

namespace App\Http\Controllers;

use App\Models\FailedLogs;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;

class Option extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function index(Request $request ){
        $data['dataTable'] = $this->dataTableParams();
        return view('Option.index', $data);
    }

    public function edit(Request $request, $optionId ){
        if($optionId){
            if($optionId=='new'){
                $data['option'] = \Instance::loadJson('option');
            } else{
                $data['option'] = \WebService::option($optionId);
            }
        } else{
            $data['option'] = [];
        }
        $html = view('Option.option-edit', $data)->render();
        return _ReturnSucces('', $html);
    }
    public function save(Request $request, $optionId ){
        $option = $request->input('option');
        if($option){
            if($optionId=='new'){
                $response = \WebService::optionNew( $option);
            } else {
                $response = \WebService::optionEdit($optionId, $option);
            }

            if($response){
                if(isset($response['data']) && isset($response['data']['optionId'])){
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
    public function deleteForm(Request $request, $optionId ){

        if($optionId){
            $data['option'] = \WebService::option($optionId);
        } else{
            $data['option'] = [];
        }
        $html = view('Option.option-delete', $data)->render();
        return _ReturnSucces('', $html);
    }

    public function delete(Request $request, $optionId ){
        $response = \WebService::option($optionId);
        if($response && isset($response['optionId'])){
            $response = \WebService::optionDelete($optionId);
            if($response){
                if( $response && isset($response['data'])){
                    $result = 'Ürün Seçeneği Silindi';
                } else{
                    $result = 'Ürün Seçeneği Silinemedi';
                }
            } else {
                $result = 'Webservis sonucu alınmadı';
            }
        } else{
            $result = 'Ürün Seçeneği bilgilerini eksik veya hatalı gönderdiniz';
        }
        return _ReturnSucces('', $result);
    }

    public function dataTable(Request $request){
        $dataTable = $this->dataTableParams();
        $params = $request->input('where', []);
        $offset = $request->input('length', 10);
        $start = $request->input('start', 0);
        $page = ($start/$offset)+1;
        $response = \WebService::options($page, $offset, $params);

        $items = [];
        if(isset($response['data']) ){
            $dataTable->setRecordsTotal(count($response['data']));
            $dataTable->setRecordsFiltered(count($response['data']));
            foreach($response['data'] as $row){
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
        $dataTable->setTableId('option-list');
        $dataTable->setUrl(route('option.data-table'));
        $dataTable->setRecordsTotal(100);
        $dataTable->setRecordsFiltered(90);
        $dataTable->setCols([
            'orderNumber'=>['title'=>'', 'className'=>'sort-order', 'orderable'=>''],
            'code'=>['title'=>'Kod', 'className'=>'', 'orderable'=>''],
            'name'=>['title'=>'Özellik', 'className'=>'', 'orderable'=>''],
            'actions'=>['title'=>'', 'className'=>'action-buttons', 'orderable'=>''],
        ]);
        return $dataTable;
    }

    private function _format_actions($row){
        return '<a class="btn waves-effect p-0 ms-1" href="'.route('option.value', $row['optionId']).'"><i class="feather icon-git-branch"></i></a> <a class="btn-popup-form btn waves-effect p-0 ms-1" data-url="'.route('option.edit', $row['optionId']).'"><i class="feather icon-file-text"></i></a> <a class="btn-popup-form btn waves-effect p-0 ms-1" data-url="'.route('option.delete.form', $row['optionId']).'"><i class="feather icon-trash text-danger"></i></a>';
    }
}
