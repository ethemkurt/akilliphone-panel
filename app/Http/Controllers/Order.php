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
        return view('Order.new', $data);
    }
    private function dataTableParams(){
        $dataTable = new \AjaxDataTable();
        $dataTable->setTableId('order-list');
        $dataTable->setUrl(route('order.data-table'));
        $dataTable->setRecordsTotal(100);
        $dataTable->setRecordsFiltered(90);
        $dataTable->setCols([
            'orderNumber'=>['title'=>'', 'className'=>'', 'orderable'=>''],
            'orderId'=>['title'=>'Sipariş No', 'className'=>'', 'orderable'=>''],
            'lastName'=>['title'=>'Soyadı', 'className'=>'', 'orderable'=>''],
            'email'=>['title'=>'Email', 'className'=>'', 'orderable'=>''],
            'phoneNumber'=>['title'=>'Telefonu', 'className'=>'', 'orderable'=>''],
            'status'=>['title'=>'Durumu', 'className'=>'', 'orderable'=>'']
        ]);
        return $dataTable;
    }

}
