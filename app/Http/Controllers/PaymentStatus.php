<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;

class PaymentStatus extends Controller{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function index(Request $request ){
        $data['dataTable'] = $this->dataTableParams();
        return view('PaymentStatus.index', $data);
    }
    public function delete(Request $request, $paymentStatusId ){
        $response = \WebService::paymentStatusDelete($paymentStatusId);
        if(isset($response['errors']) && $response['errors']){
            $html = implode(', ', $response['errors']);
            $request->session()->flash('flash-error', [$html, 'Silinemedi' ]);
        } else{
            $html = '"'.$response['data']['name'].'"';
            $request->session()->flash('flash-success', [ $html , 'Silindi']);
        }
        return redirect( route('order.payment-status'));
    }
    public function save(Request $request ){
        $html = '';
        if($paymentStatus = $request->input('paymentStatus')){
            $paymentStatusId = isset($paymentStatus['paymentStatusId'])?$paymentStatus['paymentStatusId']:false;
            if($paymentStatusId=='new'){
                unset($paymentStatus['paymentStatusId']);
                $response = \WebService::paymentStatusNew($paymentStatus);
            } else {
                $response = \WebService::paymentStatusEdit($paymentStatusId, $paymentStatus);
            }
            if(isset($response['errors']) && $response['errors']){
                $html .= implode(', ', $response['errors']);
            } else{
                if(isset($response['data']['name'])){
                    $html .= '"'.$response['data']['name'].'" Kaydedildi';
                } else{
                    $html .= ' Kaydedildi';
                }
            }
        }
        return _ReturnSucces('Kaydedildi', $html);
    }

    public function dataTable(Request $request){
        $dataTable = $this->dataTableParams();
        $offset = $request->input('length', 10);
        $start = $request->input('start', 0);
        $page = ($start/$offset)+1;
        $response = \WebService::paymentStatuses($page);
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
        $edit = route('popup', 'PaymentStatus').'?paymentStatusId='.$item['paymentStatusId'];
        $delete = route('order.payment-status-delete', $item['paymentStatusId']);
        $html = '';
        $html .= '<a class="btn-popup-form btn waves-effect p-0 ms-1" data-url="'.$edit.'" title="\''.$item['name'].'\' düzenle"><i class="feather icon-file-text"></i></a>';
        $html .= '<a class="confirm-popup btn waves-effect p-0 ms-1" href="'.$delete.'" title="\''.$item['name'].'\' silinsin mi?"><i class="feather icon-trash text-danger"></i></a> ';
        return $html;
    }
    private function dataTableParams(){
        $dataTable = new \AjaxDataTable();
        $dataTable->setTableId('payment-status');
        $dataTable->setUrl(route('order.payment-status-table'));
        $dataTable->setRecordsTotal(100);
        $dataTable->setRecordsFiltered(90);
        $dataTable->setCols([
            'orderNumber'=>['title'=>'Sıra No', 'className'=>'sort-order', 'orderable'=>''],
            'paymentStatusId'=>['title'=>'Id', 'className'=>'', 'orderable'=>''],
            'name'=>['title'=>'Adı', 'className'=>'', 'orderable'=>''],
            'action'=>['title'=>'', 'className'=>'action-buttons', 'orderable'=>''],
        ]);
        return $dataTable;
    }

}
