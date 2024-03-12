<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;

class OrderStatus extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function index(Request $request ){
        $data['dataTable'] = $this->dataTableParams();
        return view('OrderStatus.index', $data);
    }
    public function delete(Request $request, $orderStatusId ){
        $response = \WebService::orderStatusDelete($orderStatusId);
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
        $html = '';
        if($orderStatus = $request->input('orderStatus')){
            $orderStatusId = isset($orderStatus['orderStatusId'])?$orderStatus['orderStatusId']:false;
            if($orderStatusId=='new'){
                unset($orderStatus['orderStatusId']);
                $response = \WebService::orderStatusNew($orderStatus);
            } else {
                $response = \WebService::orderStatusEdit($orderStatusId, $orderStatus);
            }
            if(isset($response['errors']) && $response['errors']){
                $html .= implode(', ', $response['errors']);
            } else{
                $html .= '"'.$response['data']['name'].'" Kaydedildi';
            }
        }
        return _ReturnSucces('Kaydedildi', $html);
    }
    /*public function new(Request $request ){
        $data['orderStatus'] = [];
        return view('Order.new', $data);
    }*/
    public function dataTable(Request $request){
        $dataTable = $this->dataTableParams();
        $offset = $request->input('length', 10);
        $start = $request->input('start', 0);
        $page = ($start/$offset)+1;
        $response = \WebService::orderStatuses($page);
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
        $edit = route('popup', 'OrderStatus').'?orderStatusId='.$item['orderStatusId'];
        $delete = route('order.order-status-delete', $item['orderStatusId']);
        $html = '';
        $html .= '<a class="btn-popup-form btn waves-effect p-0 ms-1" data-url="'.$edit.'" title="\''.$item['name'].'\' düzenle"><i class="menu-icon tf-icons ti ti-file-text"></i></a>';
        $html .= '<a class="confirm-popup btn waves-effect p-0 ms-1" href="'.$delete.'" title="\''.$item['name'].'\' silinsin mi?"><i class="menu-icon tf-icons ti ti-trash"></i></a> ';
        return $html;
    }
    private function dataTableParams(){
        $dataTable = new \AjaxDataTable();
        $dataTable->setTableId('order-status');
        $dataTable->setUrl(route('order.order-status-table'));
        $dataTable->setRecordsTotal(100);
        $dataTable->setRecordsFiltered(90);
        $dataTable->setCols([
            'orderNumber'=>['title'=>'Sıra', 'className'=>'sort-order', 'orderable'=>''],
            'orderStatusId'=>['title'=>'Id', 'className'=>'', 'orderable'=>''],
            'code'=>['title'=>'Kod', 'className'=>'', 'orderable'=>''],
            'name'=>['title'=>'Adı', 'className'=>'', 'orderable'=>''],
            'action'=>['title'=>'Adı', 'className'=>'action-buttons', 'orderable'=>''],
        ]);
        return $dataTable;
    }

}
