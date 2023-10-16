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
        $response = \WebService::products();
        $data['products'] =$response['items'];
        return view('Order.new', $data);
    }
    public function newOrder(Request $request ){
        $data = $request->input('order');
        $products=$request->input('products');
        $variants = explode('|', $products[0]);
        $data['customerId']=null;
        $data['orderNo']=null;
        $data['shippingCompany']="aras";
        $data['shippingTrackingNumber']="";
        $data['shippingTrackingUrl']="";
        $data['marketplaceOrderId']="";
        $data['marketplaceOrderCode']="";
        $data['customer']["customerId"]=null;
        $data['customer']["code"]=null;
        $data['customer']["tcKimlik"]=null;
        $data['shippingAddress']["customerId"]=null;
        $data['shippingAddress']["description"]=null;
        $data['shippingAddress']["zipCode"]=null;
        $data['shippingAddress']["latitude"]=null;
        $data['shippingAddress']["longitude"]=null;
        $data['shippingAddress']["placeId"]=null;
        $data['billingAddress']["customerId"]=null;
        $data['billingAddress']["description"]=null;
        $data['billingAddress']["zipCode"]=null;
        $data['billingAddress']["latitude"]=null;
        $data['billingAddress']["longitude"]=null;
        $data['billingAddress']["placeId"]=null;
        $data['billingAddress']["company"]=null;
        $data['billingAddress']["taxOffice"]=null;
        $data['billingAddress']["taxNumber"]=null;
        $product['productId']=$variants[0];
        $product['variantId']=$variants[1];
        $product['quantity']=1;

        $variant = \WebService::variant($product['variantId']);
        $product['optionId']=$variant['variantOptions'][0]['variantOptionId'];
        $product['total']=$variant['price']*$product['quantity'];
        $data['orderProducts'][]=$product;
        $total=['code'=>'products','name'=>'Ürünler Toplamı (KDV Dahil)','value'=>$product['total']];
        $data['totals'][]=$total;
        $data['orderTotal']=$product['total'];




        $response = \WebService::newOrder($data);

        if(!$response){
            $request->session()->flash('flash-error', ['Bilgileri Tekrar Kontrol Ediniz ', 'Sipariş Oluşturulamadı.']);
        }
        else{
            $request->session()->flash('flash-success', ['Sipariş Başarılı Bir Şekilde Oluşturuldu. ', 'Sipariş Oluşturuldu.']);

        }

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
    private function _format_orderTotal($item){
        return $item['orderTotal'].' TL';
    }
    private function _format_firstName($item){
        return $item['shippingAddress']['firstName'].' '.$item['shippingAddress']['lastName'];
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
            'firstName'=>['title'=>'Ad', 'className'=>'', 'orderable'=>''],
            'orderNumber'=>['title'=>'Sipariş No', 'className'=>'', 'orderable'=>''],
            'paymentTypeId'=>['title'=>'Ödeme Türü', 'className'=>'', 'orderable'=>''],
            'shippingCompany'=>['title'=>'Kargo', 'className'=>'', 'orderable'=>''],
            'orderTotal'=>['title'=>'Toplam', 'className'=>'', 'orderable'=>''],
            'orderStatusId'=>['title'=>'OrderStatus', 'className'=>'', 'orderable'=>''],
        ]);
        return $dataTable;
    }

}
