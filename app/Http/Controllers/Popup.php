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

    public function ImageTest(Request $request ){
        $data['userType'] = $request->input('userType', 'uye');
        $data['userId'] = $request->input('userId', 'new');

        if($data['userId']=='new'){
            $data['user'] = \Instance::user();
        } else {
            $response = \Webservice::user($data['userId']);
            if(isset($response['id'])){
                $data['user'] = $response;
            } else{
                return _ReturnError('', '',['Kullanıcı Bulunamadı']);
            }
        }
        $html = view('popup-forms.imageTest', $data)->render();
        return _ReturnSucces('', $html);

    }
    public function User(Request $request ){
        $data['userType'] = $request->input('userType', 'uye');
        $data['userId'] = $request->input('userId', 'new');

        if($data['userId']=='new'){
            $data['user'] = \Instance::user();
        } else {
            $response = \Webservice::user($data['userId']);
            if(isset($response['id'])){
                $data['user'] = $response;
            } else{
                return _ReturnError('', '',['Kullanıcı Bulunamadı']);
            }
        }
        $html = view('popup-forms.user', $data)->render();
        return _ReturnSucces('', $html);
    }
    public function deleteUser(Request $request){
        $userId = $request->input('userId');
        if($userId){
            $data['user'] = \Webservice::user($userId);
        } else {
            $data['user'] = [];
        }
        $html = view('popup-forms.user-delete', $data)->render();
        return _ReturnSucces('', $html);
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
    public function BrandEdit(Request $request ){
        $brandId = $request->input('brandId');
        $data['brand'] = [];
        if($brandId){
            $response = \Webservice::brand($brandId);
            if(isset($response['brandId'])){
                $data['brand'] = $response;
            }
        }
        $html = view('popup-forms.brand-edit', $data)->render();
        return _ReturnSucces('', $html);
    }

    public function BrandSave(Request $request ){
        $brandId = $request->input('brandId');
        $data['brand'] = [];
        if($brandId){
            $response = \Webservice::brand($brandId);
            if(isset($response['brandId'])){
                $data['brand'] = $response;
            }
        }
        $html = view('popup-forms.brand-save',$data)->render();
        return _ReturnSucces('', $html);
    }

    public function CategoriesSave(Request $request ){
//        $brandId = $request->input('brandId');
          $data['categories'] = [];
          $response = \Webservice::categories(1);

          if($response!=[]){
                $data['categories'] = $response;
            }

        $html = view('popup-forms.categories-save',$data)->render();
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
