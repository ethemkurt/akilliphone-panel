<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;

class Order extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function index(Request $request ){
        $data['dataTable'] = $this->dataTableParams();
        return view('Order.index', $data);
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
        $response = \WebService::orders($page, $offset);
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
    private function _format_orderStatusId($item){
        $options = '<option value="" selected disabled>Sipariş Durumu Seçiniz</option>';
        foreach(\Enum::list('orderStatus') as $orderStatusId=>$orderStatus){
            $selected = $orderStatusId == $item['orderStatusId']?'selected':'';
            $options .= '<option value="'.$orderStatusId.'" '.$selected.'>'.$orderStatus.$item['orderStatusId'].'</option>';
        }
        return '<div class="input-group mb-2">
                                        <select class="form-select" placeholder="Search..." aria-label="Search..." aria-describedby="basic-addon-search1">'.$options.'</select><button class="input-group-text btn-primary" id="basic-addon-search1"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check me-25"><polyline points="20 6 9 17 4 12"></polyline></svg></button>
                                    </div>';
    }
    private function _format_orderTotal($item){
        return $item['orderTotal'].' TL';
    }
    private function _format_paymentTypeId($item){
        return '<span class="badge rounded-pill badge-light-'.\PaymentType::color($item['paymentTypeId']).'" text-capitalized="">'.\PaymentType::__($item['paymentTypeId']).'</span>';
    }
    private function dataTableParams(){
        $dataTable = new \AjaxDataTable();
        $dataTable->setTableId('order-list');
        $dataTable->setUrl(route('order.data-table'));
        $dataTable->setRecordsTotal(100);
        $dataTable->setRecordsFiltered(90);
        $dataTable->setCols([
            'orderNumber'=>['title'=>'Sipariş No', 'className'=>'', 'orderable'=>''],
            'paymentTypeId'=>['title'=>'Ödeme Türü', 'className'=>'', 'orderable'=>''],
            'orderStatusId'=>['title'=>'Durumu', 'className'=>'', 'orderable'=>''],
            'shippingCompany'=>['title'=>'Kargo', 'className'=>'', 'orderable'=>''],
            'orderTotal'=>['title'=>'Toplam', 'className'=>'', 'orderable'=>''],
        ]);
        return $dataTable;
    }

}
