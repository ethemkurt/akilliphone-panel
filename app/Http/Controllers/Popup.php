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

    public function User(Request $request ){
        $data['userType'] = $request->input('userType', 'uye');
        $data['userId'] = $request->input('userId', 'new');
        if($data['userId']=='new'){
            $data['user'] = \Instance::user();
        } else {
            $response = \Webservice::user($data['userId']);
            if(isset($response['paymentStatusId'])){
                $data['user'] = $response;
            } else{
                return _ReturnError('', '',['Kullanıcı Bulunamadı']);
            }
        }
        $html = view('popup-forms.user', $data)->render();
        return _ReturnSucces('', $html);
    }

    public function changeOrderState(Request $request ){
        $orderId = $request->input('orderId');
        $orderStatusId = $request->input('orderStatusId');
        if($orderId){
            $order = \WebService::order($orderId);
            if($order && isset($order['orderStatusId'])){
                $order['orderStatusId'] = $orderStatusId;
                $response = \WebService::editOrder($orderId, $order);
                if($response && isset($response['data']['orderStatusId']) && isset($response['data']['orderStatusId'])){
                    \KargoService::siparisDurumunaGoreKargola($response['data']);
                    return _ReturnSucces('', '<i class="fa fa-check text-success"></i> Sipariş Durumu Güncellendi');
                }
            }
        }
        return _ReturnSucces('', '<i class="fa fa-times text-danger"></i> Sipariş Durumu Güncellenemedi');
    }
    public function OrderStatus(Request $request ){
        $orderStatusId = $request->input('orderStatusId');
        $data['orderStatus'] = [];
        if($orderStatusId){
            $response = \Webservice::orderStatus($orderStatusId);
            if(isset($response['orderStatusId'])){
                $data['orderStatus'] = $response;
            }
        }
        $html = view('popup-forms.order-status', $data)->render();
        return _ReturnSucces('', $html);
    }
    public function PaymentStatus(Request $request ){
        $paymentStatusId = $request->input('paymentStatusId');
        $data['paymentStatus'] = [];
        if($paymentStatusId){
            $response = \Webservice::paymentStatus($paymentStatusId);
            if(isset($response['paymentStatusId'])){
                $data['paymentStatus'] = $response;
            }
        }
        $html = view('popup-forms.payment-status', $data)->render();
        return _ReturnSucces('', $html);
    }
    public function PaymentType(Request $request ){
        $paymentTypeId = $request->input('paymentTypeId');
        $data['paymentType'] = [];
        if($paymentTypeId){
            $response = \Webservice::paymentType($paymentTypeId);
            if(isset($response['paymentTypeId'])){
                $data['paymentType'] = $response;
            }
        }
        $html = view('popup-forms.payment-type', $data)->render();
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
