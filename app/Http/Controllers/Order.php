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
    public function view(Request $request, $orderId){
        $data['order'] = \WebService::order($orderId);
        $data['orderHistory'] = \WebService::orderHistory($orderId);
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
        if($request->input('same-address')){
            if(isset($order['shippingAddress'])){
                if(empty($order['shippingAddress']['addressLine2']))$order['shippingAddress']['addressLine2']="";
            }
            $order['billingAddress'] = $order['shippingAddress'];
        } else{
            if(isset($order['shippingAddress'])){
                if(empty($order['shippingAddress']['addressLine2']))$order['shippingAddress']['addressLine2']="";
            }
            if(isset($order['billingAddress'])){
                if(empty($order['billingAddress']['addressLine2']))$order['billingAddress']['addressLine2']="";
            }

        }
        if($orderId=='new'){
            unset($order['orderId']);
            $response = \WebService::newOrder($order);
            dd(json_encode($order), $response);
            $order['orderId'] = 'new';
        } else {
            $response = \WebService::editOrder($orderId, $order);
        }

        if(isset($response['errors']) && $response['errors']){
            $responseErrors = [];
            foreach($response['errors'] as $errors){

                if(is_string($errors)){
                    $responseErrors[] =  $errors;;
                } else {
                    foreach($errors as $error){
                        $responseErrors[] = $error;
                    }
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

            \WebService::orderHistoryDelete($orderId);
            $response = \WebService::orderDelete($orderId);
            if(isset($response['errors']) && $response['errors']){
                $errors = [];
                foreach($response['errors'] as $error){
                    if(is_string($error)){
                        $errors[] = $error;
                    } elseif (is_array($error) && isset($error['message'])){
                        $errors[] = $error['message'];
                    }
                }
                return _ReturnError('', '', $errors);
            } else {
                return _ReturnSucces('', 'Sipariş Silindi');
            }
        } else{
            return _ReturnError('', '', ['Sipariş Bulunamadı']);
        }
    }
    public function barcode(Request $request, $orderId){
        $data['order'] = \WebService::order($orderId);
        return view('Order.barcode', $data);

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
        $params = $request->input('where', []);
        $search = $request->input('search', []);
        if(isset($search['value']) && $search['value']){
            /**
             * SearchFor parametresi NameSurname, ProductCode ya da OrderNo içerisinde arıyor
             */
            $params['text'] = $search['value'];
            $params['searchFor'] = 'nameSurname';
        }

        $response = \WebService::orders($page, $offset, $params);

        $dataTable->setRecordsTotal(isset($response['totalCount'])?$response['totalCount']:0);
        $dataTable->setRecordsFiltered(isset($response['filteredCount'])?$response['filteredCount']:0);
        $items = [];
        if($response && isset($response['items'])){
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
        }

        $dataTable->setItems($items);
        return $dataTable->toJson();
    }
    private function _format_checkBox($item) {
        return '<input type="checkbox" class="form-check-input">';
    }
    private function _format_orderStatusId($item) {
        return '<h6 class="mb-0 align-items-center d-flex w-px-100 text-'.\OrderStatus::color($item['orderStatusId']).'" style="white-space: nowrap;">'.\OrderStatus::__($item['orderStatusId']).'</h6>';

    }
    /*
    private function _format_orderStatusId($item) {
        //return '<h6 class="mb-0 align-items-center d-flex w-px-100 text-'.\OrderStatus::color($item['orderStatusId']).'"><i class="ti ti-circle-filled fs-tiny me-2"></i>'.\OrderStatus::__($item['orderStatusId']).'</h6>';

        $options = '<option value="" selected disabled>Sipariş Durumu Seçiniz</option>';
        foreach(\Enum::list('orderStatus') as $orderStatusId=>$orderStatus){
            $selected = $orderStatusId == $item['orderStatusId']?'selected':'';
            $options .= '<option value="'.$orderStatusId.'" '.$selected.'>'.$orderStatus.'</option>';
        }
        return '<div class="input-group">
                <select class="form-select tiny select-order-status-id" aria-describedby="basic-addon-search1">'.$options.'</select>
                <button class="input-group-text btn-change-order-state" data-orderid="'.$item['orderId'].'" id="basic-addon-search1"><i class="fa fa-check"></i>
                </button>
            </div>';
    } */
    private function _format_orderTotal($item){
        return  _FormatPrice($item['orderTotal']);
    }
    private function _format_shippingCompany($item){
        return  $item['shippingCompany'];//_Image('kargo/'.$item['shippingCompany'].'.png', 18,18);
    }
    private function _format_firstName($item){
       if($item['shippingAddress']){
           return _OrderUserAvatar($item);
       }
    }

    private function _format_orderId($item)
    {
        $html = $item['orderId'];
        return $html;
    }

    private function _format_createdAt($item){
        //$html = $item['orderId'];
        $html = _HumanDate($item['createdAt']);
        return $html;
    }
    private function _format_paymentStatusId($item){
        return '<h6 class="mb-0 align-items-left d-flex w-px-100 text-'.\PaymentStatus::color($item['paymentStatusId']).'">'.\PaymentStatus::__($item['paymentStatusId']).'</h6>';

    }
    private function _format_paymentTypeId($item){
        return
'<div class="d-flex align-items-center text-nowrap"><img src="'.\PaymentType::icon($item['paymentTypeId']).'" alt="mastercard" class="me-2" width="16"><span class="text-'.\PaymentType::color($item['paymentTypeId']).'">'.\PaymentType::__($item['paymentTypeId']).'</span></div>';
    }
    private function _format_actions($item){
        $barcodeUrl = route('order.barcode', $item['orderId']);
        $editUrl = route('order.edit', $item['orderId']);
        $viewUrl = route('order.view', $item['orderId']);
        $deleteUrl = route('popup', 'deleteOrder').'?orderId='. $item['orderId'];
        return '<div class="dropdown">
                    <button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0 waves-effect waves-float waves-light" data-bs-toggle="dropdown">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-vertical"><circle cx="12" cy="12" r="1"></circle><circle cx="12" cy="5" r="1"></circle><circle cx="12" cy="19" r="1"></circle></svg>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end">
                        <a class="dropdown-item" href="'.$viewUrl.'">
                            <i class="menu-icon tf-icons ti ti-file-text"></i>
                            <span>Görüntüle</span>
                        </a>
                        <a class="dropdown-item" href="'.$editUrl.'">
                            <i class="menu-icon tf-icons ti ti-edit"></i>
                            <span>Düzenle</span>
                        </a>
                        <a class="dropdown-item" href="'.$barcodeUrl.'" target="_blank">
                            <i class="menu-icon tf-icons ti ti-barcode"></i>
                            <span>Barkod Yazdır</span>
                        </a>
                        <button class="dropdown-item btn-popup-form" data-url="'.$deleteUrl.'">
                            <i class="menu-icon tf-icons ti ti-trash"></i>
                            <span>Sil</span>
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

            'checkBox'=>['title'=>'', 'className'=>'checkbox', 'orderable'=>''],
            'orderId'=>['title'=>'No', 'className'=>'', 'orderable'=>''],
            'createdAt'=>['title'=>'Tarihi', 'className'=>'', 'orderable'=>''],

            'firstName'=>['title'=>'Müşteri', 'className'=>'', 'orderable'=>''],
            'paymentStatusId'=>['title'=>'Ödemesi', 'className'=>'', 'orderable'=>''],
            'orderStatusId'=>['title'=>'Durumu', 'className'=>'', 'orderable'=>''],
            'paymentTypeId'=>['title'=>'Ödeme Tipi', 'className'=>'', 'orderable'=>''],
            //'orderTotal'=>['title'=>'Toplam', 'className'=>'', 'orderable'=>''],
            'actions'=>['title'=>'', 'className'=>'', 'orderable'=>''],
        ]);
        $dataTable->setFiters('Order.datatable-filter', \request()->all());
        return $dataTable;
    }
    private function mergeOrder($data, $order){

    }
}
