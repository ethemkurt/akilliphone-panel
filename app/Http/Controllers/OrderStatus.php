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
    public function save(Request $request ){
        $data['status']=1;
        $data['html']='Katdedildi';
        returnSucces($data);
    }
    public function detail(Request $request, $orderId ){
        $data['order'] = \WebService::order($orderId);
        return view('Order.detail', $data);
    }
    public function new(Request $request ){
        $data = [];
        $order = [
            'paymentStatus'=>\PaymentStatus::BEKLIYOR,
            'paymentType'=>\PaymentType::KREDIKARTI,
            ];
        return view('Order.new', $data);
    }
    public function dataTable(Request $request){
        $dataTable = $this->dataTableParams();
        $offset = $request->input('length', 10);
        $start = $request->input('start', 0);
        $page = ($start/$offset)+1;
        $response = \WebService::order_status($page);
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
        $url = route('popup', 'OrderStatus').'?orderStatusId='.$item['orderStatusId'];
        $html = poupFormButton($url, '', '', '');
        $html .= '<a class="btn confirm-popup" href="'.$url.'" title="\''.$item['name'].'\' silinsin mi?"><i class="fa fa-trash"></i></a>';
        return '<div class="text-end">'.$html.'</div>';
    }
    private function dataTableParams(){
        $dataTable = new \AjaxDataTable();
        $dataTable->setTableId('order-status');
        $dataTable->setUrl(route('order.status-table'));
        $dataTable->setRecordsTotal(100);
        $dataTable->setRecordsFiltered(90);
        $dataTable->setCols([
            'orderNumber'=>['title'=>'Sıra No', 'className'=>'', 'orderable'=>''],
            'orderStatusId'=>['title'=>'Id', 'className'=>'', 'orderable'=>''],
            'name'=>['title'=>'Adı', 'className'=>'', 'orderable'=>''],
            'action'=>['title'=>'Adı', 'className'=>'', 'orderable'=>''],
        ]);
        return $dataTable;
    }

}
