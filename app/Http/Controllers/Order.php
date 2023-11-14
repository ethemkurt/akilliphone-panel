<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;

class Order extends Controller{
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
        return $this->edit($request, 'new');
    }
    public function newOrder(Request $request ){
        return $this->editOrder($request, 'new');
    }
    /*public function newOrder(Request $request ){
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

        return view('Order.new', []);

    }*/
    public function view(Request $request, $orderId){
        $data['order'] = \WebService::order($orderId);
        return view('Order.view', $data);
    }
    public function editOrder(Request $request, $orderId){
        $order = $request->input('order');
        if(isset($order['totals'])){
            foreach($order['totals'] as $total){
                $totals[] =  $total;
            }
            $order['totals'] = $totals;
        }
        if(isset($order['orderProducts'])){
            foreach($order['orderProducts'] as $orderProduct){
                $orderProducts[] =  $orderProduct;
            }
            $order['orderProducts'] = $orderProducts;
        }
        if(isset($order['shippingAddress'])){
            if(empty($order['shippingAddress']['addressLine2']))$order['shippingAddress']['addressLine2']="";
        }
        if(isset($order['billingAddress'])){
            if(empty($order['billingAddress']['addressLine2']))$order['billingAddress']['addressLine2']="";
        }
        if($orderId=='new'){
            unset($order['orderId']);
            $response = \WebService::newOrder($order);
            $order['orderId'] = 'new';
        } else {
            $response = \WebService::editOrder($orderId, $order);
        }

        if(isset($response['errors']) && $response['errors']){
            $responseErrors = [];
            foreach($response['errors'] as $errors){
                foreach($errors as $error){
                    $responseErrors[] = $error;
                }
            }
            $request->session()->flash('flash-error', ['', implode(" ", $responseErrors)]);
            return back()->withInput(['order'=>$order]);
        } else{
            $orderId = isset($response['orderId'])?$response['orderId']:$orderId;
        }
        return redirect(route('order.edit', $orderId));
    }
    public function edit(Request $request, $orderId){
        $oldOrder = old('order');
        if($oldOrder){
            $data['order'] = $oldOrder;
        }elseif($orderId=='new'){
            $data['order'] = \Instance::Order();
        } else{
            $data['order'] = \WebService::order($orderId);
        }
        if(!isset($data['order']['createdAt'])){
            $data['order']['createdAt'] = 'Y-m-d H:i:s';
        }
        if(!isset($data['order']['orderCustomer'])){
            $data['order']['orderCustomer'] = $data['order']['customer'];
        }
        if(isset($data['order']['orderTotals'])){
            $totals = [];
            foreach ($data['order']['orderTotals'] as $orderTotal){
                $totals[$orderTotal['code']] = $orderTotal['code'];
            }
            if(!isset($totals['products'])){
                $data['order']['orderTotals']['products'] = ['code'=>'products', 'name'=>'Ürünler Toplamı (KDV Dahil)', 'value'=>'0'];
            }
            if(!isset($totals['shipping'])){
                $data['order']['orderTotals']['shipping'] = ['code'=>'shipping', 'name'=>'Kargo', 'value'=>'0'];
            }
            if(!isset($totals['discount'])){
                $data['order']['orderTotals']['discount'] = ['code'=>'discount', 'name'=>'İndirim', 'value'=>'0'];
            }
        } else {
            $data['order']['orderTotals'][] = ['code'=>'products', 'name'=>'Ürün Toplamı', 'value'=>'0'];
            $data['order']['orderTotals'][] = ['code'=>'shipping', 'name'=>'Kargo', 'value'=>'0'];
            $data['order']['orderTotals'][] = ['code'=>'discount', 'name'=>'İndirim', 'value'=>'0'];
        }
        $data['countries'] = \WebService::countries();
        $data['cities'] = \WebService::cities();
        return view('Order.edit', $data);
    }
    public function delete(Request $request, $orderId){
        if($orderId){
            $response = \WebService::orderDelete($orderId);
            if(isset($response['errors']) && $response['errors']){
                $errors = [];
                foreach($response['errors'] as $error){
                    $errors[] = $error['message'];
                }
                return _ReturnError('', '', $errors);
            } else {
                return _ReturnSucces('', 'silindi', route('order.index'));
            }
        } else{
            return _ReturnError('', '', ['Sipariş Bulunamadı']);
        }
    }
    public function findProductForm(Request $request){
        $data = [];
        $html = view('Order.findProductForm', $data)->render();
        return ['status'=>1, 'message'=>'m', 'html'=>$html];
    }
    public function findProductSelect2(Request $request){
        $data['results'] = [];
        $response = \WebService::products(['offset'=>25, 'page'=>1,'text'=>$request->input('term')]);

        if($response && isset($response['items'])){
            foreach($response['items'] as $item){
                $data['results'][] = [
                    'id'=>$item['productId'],
                    'text'=> $item['name'].'#'. $item['code'],
                    'image'=> getProductImageUrl($item['featuredImage'], 18,18),
                    'variants'=>$item['variants']
                ];
            }
        }
        return $data;
    }
    public function addProductToOrder(Request $request){
        $html = '';
        if($variantId = $request->input('variantId')){
            $data['variant'] = \WebService::variant($variantId);
            if($data['variant'] && isset($data['variant']['variantId'])){
                $html = view('Order.order-add-product-item', $data)->render();
            }
        }
        return ['status'=>1, 'message'=>'m', 'html'=>$html];
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
    private function _format_orderStatusId($item) {
        return '<h6 class="mb-0 align-items-center d-flex w-px-100 text-'.\OrderStatus::color($item['orderStatusId']).'"><i class="ti ti-circle-filled fs-tiny me-2"></i>'.\OrderStatus::__($item['orderStatusId']).'</h6>';

        /*$options = '<option value="" selected disabled>Sipariş Durumu Seçiniz</option>';
        foreach(\Enum::list('orderStatus') as $orderStatusId=>$orderStatus){
            $selected = $orderStatusId == $item['orderStatusId']?'selected':'';
            $options .= '<option value="'.$orderStatusId.'" '.$selected.'>'.$orderStatus.'</option>';
        }
        return '<div class="input-group mb-2">
                <select class="form-select" aria-describedby="basic-addon-search1">'.$options.'</select>
                <button class="input-group-text btn-primary" id="basic-addon-search1"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check me-25"><polyline points="20 6 9 17 4 12"></polyline></svg>
                </button>
            </div>';*/
    }
    private function _format_orderTotal($item){
        return  _FormatPrice($item['orderTotal']);
    }
    private function _format_shippingCompany($item){
        return  _Image('kargo/'.$item['shippingCompany'].'.png', 18,18);
    }
    private function _format_firstName($item){
       if($item['shippingAddress']){
           return '<div class="d-flex justify-content-start align-items-center order-name text-nowrap"><div class="d-flex flex-column"><h6 class="m-0"><a href="pages-profile-user.html" class="text-body">'.$item['shippingAddress']['firstName'].' '.$item['shippingAddress']['lastName'].'</a></h6><small class="text-muted">'.$item['orderCustomer']['email'].'</small></div></div>';
       }
    }
    private function _format_createdAt($item){
        return _HumanDate($item['createdAt']);
    }
    private function _format_paymentTypeId($item){
        return '<h6 class="mb-0 align-items-center d-flex w-px-100 text-'.\PaymentType::color($item['paymentTypeId']).'"><i class="ti ti-circle-filled fs-tiny me-2"></i>'.\PaymentType::__($item['paymentTypeId']).'</h6>';

    }
    private function _format_actions($item){
        $editUrl = route('order.edit', $item['orderId']);
        $viewUrl = route('order.view', $item['orderId']);
        $deleteUrl = route('popup', 'deleteOrder').'?orderId='. $item['orderId'];
        return '<div class="dropdown">
                    <button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0 waves-effect waves-float waves-light" data-bs-toggle="dropdown">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-vertical"><circle cx="12" cy="12" r="1"></circle><circle cx="12" cy="5" r="1"></circle><circle cx="12" cy="19" r="1"></circle></svg>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end">
                        <a class="dropdown-item" href="'.$viewUrl.'">
                            <i class="feather icon-file-text"></i>
                            <span>Görüntüle</span>
                        </a>
                        <a class="dropdown-item" href="'.$editUrl.'">
                            <i class="feather icon-edit"></i>
                            <span>Düzenle</span>
                        </a>
                        <button class="dropdown-item btn-popup-form" data-url="'.$deleteUrl.'">
                            <i class="feather icon-trash-2"></i>
                            <span>Delete</span>
                        </button>
                    </div>
                </div>';
    }
    private function dataTableParams(){
        $dataTable = new \AjaxDataTable();
        $dataTable->setTableId('order-list');
        $dataTable->setUrl(route('order.data-table'));
        $dataTable->setRecordsTotal(100);
        $dataTable->setRecordsFiltered(90);
        $dataTable->setCols([
            'orderNumber'=>['title'=>'Sipariş No', 'className'=>'', 'orderable'=>''],
            'createdAt'=>['title'=>'Tarih', 'className'=>'', 'orderable'=>''],
            'firstName'=>['title'=>'Ad', 'className'=>'', 'orderable'=>''],
            'paymentTypeId'=>['title'=>'Ödeme Türü', 'className'=>'', 'orderable'=>''],
            'orderStatusId'=>['title'=>'Durumu', 'className'=>'', 'orderable'=>''],
            'shippingCompany'=>['title'=>'Kargo', 'className'=>'', 'orderable'=>''],
            'orderTotal'=>['title'=>'Toplam', 'className'=>'', 'orderable'=>''],
            'actions'=>['title'=>'', 'className'=>'', 'orderable'=>''],
        ]);
        return $dataTable;
    }
    private function mergeOrder($data, $order){

    }
}
