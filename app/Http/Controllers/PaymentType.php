<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;

class PaymentType extends Controller{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function index(Request $request ){
        $data['dataTable'] = $this->dataTableParams();
        return view('PaymentType.index', $data);
    }
    public function delete(Request $request, $paymentTypeId ){
        $response = \WebService::paymentTypesDelete($paymentTypeId);
        if(isset($response['errors']) && $response['errors']){
            $html = implode(', ', $response['errors']);
            $request->session()->flash('flash-error', [$html, 'Silinemedi' ]);
        } else{
            $html = '"'.$response['data']['name'].'"';
            $request->session()->flash('flash-success', [ $html , 'Silindi']);
        }
        return redirect( route('order.order-status'));
    }
    public function save(Request $request ){
        $html = 'İşlem Yapılamadı';
        if($paymentType = $request->input('paymentType')){
            $paymentTypeId = isset($paymentType['paymentTypeId'])?$paymentType['paymentTypeId']:false;
            if($paymentTypeId=='new'){
                $response = \WebService::paymentTypeNew($paymentType);
            } else {
                $response = \WebService::paymentTypeEdit($paymentTypeId, $paymentType);
            }
            if(isset($response['errors']) && $response['errors']){
                $html = implode(', ', $response['errors']);
            } else{
                $html = '"'.$response['data']['name'].'" Kaydedildi';
            }
        }
        return _ReturnSucces('Kaydedildi', $html);
    }

    public function dataTable(Request $request){
        $dataTable = $this->dataTableParams();
        $offset = $request->input('length', 10);
        $start = $request->input('start', 0);
        $page = ($start/$offset)+1;
        $response = \WebService::paymentTypes($page);
        $dataTable->setRecordsTotal(count($response));
        $dataTable->setRecordsFiltered(count($response));
        $items = [];
        foreach($response as $row){
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
        $edit = route('popup', 'PaymentType').'?paymentTypeId='.$item['paymentTypeId'];
        $delete = route('order.payment-type-delete', $item['paymentTypeId']);
        $html = '';//poupFormButton($url, '', '', '');
        $html .= '<a class="btn confirm-popup" href="'.$delete.'" title="\''.$item['name'].'\' silinsin mi?"><i class="fa fa-trash"></i></a> ';
        $html .= '<a class="btn btn-popup-form" data-url="'.$edit.'" title="\''.$item['name'].'\' düzenle"><i class="fa fa-edit"></i></a>';
        return '<div class="text-end">'.$html.'</div>';
    }
    private function dataTableParams(){
        $dataTable = new \AjaxDataTable();
        $dataTable->setTableId('payment-type');
        $dataTable->setUrl(route('order.payment-type-table'));
        $dataTable->setRecordsTotal(100);
        $dataTable->setRecordsFiltered(90);
        $dataTable->setCols([
            'orderNumber'=>['title'=>'Sıra No', 'className'=>'', 'orderable'=>''],
            'paymentTypeId'=>['title'=>'Id', 'className'=>'', 'orderable'=>''],
            'name'=>['title'=>'Adı', 'className'=>'', 'orderable'=>''],
            'action'=>['title'=>'', 'className'=>'', 'orderable'=>''],
        ]);
        return $dataTable;
    }

}
