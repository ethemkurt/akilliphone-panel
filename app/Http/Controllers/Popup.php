<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;

class Popup extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function index(Request $request, $method ){
        if(method_exists($this, $method)){
            return $this->{$method}($request);
        }
    }
    public function OrderStatus(Request $request ){
        $orderStatusId = $request->input('orderStatusId');
        if($orderStatusId){
            $data['orderStatus'] = \Webservice::order_state($orderStatusId);
        } else {
            $data['orderStatus'] = [];
        }
        $html = view('popup-forms.product-status', $data)->render();
        return _ReturnSucces('', $html);
    }
    public function deleteOrder(Request $request){
        $orderId = $request->input('orderId');
        if($orderId){
            $data['order'] = \Webservice::order($orderId);
        } else {
            $data['order'] = [];
        }
        $html = view('popup-forms.order-delete', $data)->render();
        return _ReturnSucces('', $html);
    }
}
