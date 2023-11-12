
@extends('layouts/contentLayoutMaster')

@section('title', 'Sipariş Bilgileri')

@section('page-style')
    {{-- Page Css files --}}
    <link rel="stylesheet" type="text/css" href="{{asset('css/base/plugins/forms/pickers/form-flat-pickr.css')}}">
@endsection

@section('content')
    <!-- Advanced Search -->
    <section id="advanced-search-datatable">
        @if($order)
            <form class="form form-horizontal" method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <input type="hidden" name="order[orderId]" value="{{ $order['orderId'] }}" />
                <input type="hidden" name="order[customerId]" value="{{ $order['customerId'] }}" />
                <input type="hidden" name="order[marketplaceId]" value="{{ $order['marketplaceId'] }}" />
                <input type="hidden" name="order[shippingCompany]" value="{{ $order['shippingCompany'] }}" />
                <input type="hidden" name="order[shippingTrackingNumber]" value="{{ $order['shippingTrackingNumber'] }}" />
                <input type="hidden" name="order[shippingTrackingUrl]" value="{{ (string)$order['shippingTrackingUrl'] }}" />
                <input type="hidden" name="order[marketplaceOrderId]" value="{{ (string)$order['marketplaceOrderId'] }}" />
                <input type="hidden" name="order[marketplaceOrderCode]" value="{{ (string)$order['marketplaceOrderCode'] }}" />

                <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">

                <div class="d-flex flex-column justify-content-center gap-2 gap-sm-0">
                    <h5 class="mb-1 mt-1 d-flex flex-wrap gap-2 align-items-end">Sipariş No #{{ $order['orderId'] }}
                        <span class="badge bg-{{ \PaymentType::color($order['paymentTypeId']) }}">Ödeme Türü: {{ \PaymentType::__($order['paymentTypeId']) }}</span>
                        <span class="badge bg-{{ \OrderStatus::color($order['orderStatusId']) }}">Sipariş Durumu: {{ \OrderStatus::__($order['orderStatusId']) }}</span></h5>
                    <p class="text-body">{{ _HumanDate($order['createdAt'], 'd.m.Y') }}</p>
                </div>
                <div class="d-flex align-content-center flex-wrap gap-2">
                    <button class="btn btn-success edit-order waves-effect" type="submit">Kaydet</button>
                </div>
            </div>
                <div class="row">
                    <div class="col-12">
                        <div class="row equal mb-3">
                            <div class="col-md-3">
                                <div class="card full-height mb-4">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <h5 class="card-title m-0">Sipariş Bilgileri</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="col-12">
                                            <div class="mb-1 row">
                                                <div class="col-sm-3"><label class="col-form-label" for="contact-info">Ödeme Metodu</label></div>
                                                <div class="col-sm-9">
                                                        <?php
                                                        $options = '<option value="" selected disabled>Ödeme Metodu Seçiniz</option>';
                                                        foreach(\Enum::list('paymentType') as $paymentTypeId=>$paymentType){
                                                            $selected = $paymentTypeId == $order['paymentTypeId']?'selected':'';
                                                            $options .= '<option value="'.$paymentTypeId.'" '.$selected.'>'.$paymentType.'</option>';
                                                        }
                                                        ?>
                                                    <select value="{{ $order['paymentTypeId'] }}" type="text" required class="form-select" name="order[paymentTypeId]" placeholder="paymentTypeId">
                                                        {!! $options !!}
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="mb-1 row">
                                                <div class="col-sm-3"><label class="col-form-label" for="contact-info">Ödeme Durumu</label></div>
                                                <div class="col-sm-9">
                                                    <?php
                                                        $options = '<option value="" selected disabled>Sipariş Durumu Seçiniz</option>';
                                                        foreach(\Enum::list('paymentStatus') as $paymentStatusId=>$paymentStatus){
                                                            $selected = $paymentStatusId == $order['paymentStatusId']?'selected':'';
                                                            $options .= '<option value="'.$paymentStatusId.'" '.$selected.'>'.$paymentStatus.'</option>';
                                                        }
                                                    ?>
                                                    <select value="{{ $order['paymentStatusId'] }}" type="text" required class="form-select" name="order[paymentStatusId]" placeholder="paymentStatusId">
                                                    {!! $options !!}
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="mb-1 row">
                                                <div class="col-sm-3"><label class="col-form-label" for="contact-info">Sipariş durumu</label></div>
                                                <div class="col-sm-9">
                                                        <?php
                                                        $options = '<option value="" selected disabled> Sipariş Durumu Seçiniz</option>';
                                                        foreach(\Enum::list('orderStatus') as $orderStatusId=>$orderStatus){
                                                            $selected = $orderStatusId == $order['orderStatusId']?'selected':'';
                                                            $options .= '<option value="'.$orderStatusId.'" '.$selected.'>'.$orderStatus.'</option>';
                                                        }
                                                        ?>
                                                    <select value="{{ $order['orderStatusId'] }}" type="text" required class="form-select" name="order[orderStatusId]" placeholder="orderStatusId">
                                                        {!! $options !!}
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="mb-1 row">
                                                <div class="col-sm-3"><label class="col-form-label" for="contact-info">Kargo</label></div>
                                                <div class="col-sm-9">

                                                    <select id="ShippingCompany" class="select-with-name form-select" data-nametarget=".select-district" name="order[shippingCompany]">
                                                        <option value=""> -- </option>
                                                        @if($cities['data'])
                                                            @foreach(\Enum::list('ShippingCompanies') as $shippingCompanyCode => $shippingCompany)
                                                                <option class="shipping-{{ $shippingCompanyCode }}" value="{{ $shippingCompanyCode }}" @if($order['shippingCompany'] == $shippingCompanyCode) selected @endif>{{ $shippingCompany }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>

                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card full-height mb-4">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <h5 class="card-title m-0">Müşteri Bilgileri</h5>
                                        <input value="{{ $order['orderCustomer']['customerId'] }}" type="hidden"  name="order[customer][customerId]" >
                                        <input value="{{ $order['orderCustomer']['code'] }}" type="hidden"  name="order[customer][code]" >
                                        <input value="{{ $order['orderCustomer']['code'] }}" type="hidden"  name="order[customer][code]" >
                                        <input value="{{ $order['orderCustomer']['tcKimlik'] }}" type="hidden"  name="order[customer][tcKimlik]" >

                                    </div>
                                    <div class="card-body">
                                        <div class="col-12">
                                            <div class="mb-1 row">
                                                <div class="col-sm-3"><label class="col-form-label" for="contact-info">Ad</label></div>
                                                <div class="col-sm-9">
                                                    <input value="{{ $order['orderCustomer']['firstName'] }}" type="text" class="form-control" name="order[customer][firstName]" placeholder="Ad">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="mb-1 row">
                                                <div class="col-sm-3"><label class="col-form-label" for="contact-info">Soyad</label></div>
                                                <div class="col-sm-9">
                                                    <input value="{{ $order['orderCustomer']['lastName'] }}" type="text" class="form-control" name="order[customer][lastName]" placeholder="Soyad">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="mb-1 row">
                                                <div class="col-sm-3"><label class="col-form-label" for="contact-info">Email</label></div>
                                                <div class="col-sm-9">
                                                    <input value="{{ $order['orderCustomer']['email'] }}" type="text" class="form-control" name="order[customer][email]" placeholder="Email">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="mb-1 row">
                                                <div class="col-sm-3"><label class="col-form-label" for="contact-info">Telefon</label></div>
                                                <div class="col-sm-9">
                                                    <input value="{{ $order['orderCustomer']['telefon'] }}" type="text" class="form-control" name="order[customer][telefon]" placeholder="Telefon">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card full-height mb-4">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <h5 class="card-title m-0">Teslimat Bilgileri</h5>
                                        <input value="{{ $order['shippingAddress']['customerId'] }}" type="hidden" name="order[shippingAddress][customerId]">
                                        <input value="{{ $order['shippingAddress']['countryId'] }}" type="hidden" name="order[shippingAddress][countryId]" value="2">
                                        <input value="{{ $order['shippingAddress']['cityId'] }}" type="hidden" name="order[shippingAddress][cityId]">
                                        <input value="{{ $order['shippingAddress']['districtId'] }}" type="hidden" name="order[shippingAddress][districtId]">
                                        <input value="{{ $order['shippingAddress']['firstName'] }}" type="hidden" name="order[shippingAddress][firstName]">
                                        <input value="{{ $order['shippingAddress']['lastName'] }}" type="hidden" name="order[shippingAddress][lastName]">
                                        <input value="" type="hidden" name="order[shippingAddress][name]">
                                        <input value="{{ $order['shippingAddress']['description'] }}" type="hidden" name="order[shippingAddress][description]">
                                        <input value="{{ $order['shippingAddress']['addressLine1'] }}" type="hidden" name="order[shippingAddress][addressLine1]">
                                        <input value="{{ $order['shippingAddress']['addressLine2'] }}" type="hidden" name="order[shippingAddress][addressLine2]">
                                        <input value="{{ $order['shippingAddress']['country'] }}" type="hidden" name="order[shippingAddress][country]">
                                        <input value="{{ $order['shippingAddress']['city'] }}" type="hidden" name="order[shippingAddress][city]">
                                        <input value="{{ $order['shippingAddress']['district'] }}" type="hidden" name="order[shippingAddress][district]">
                                        <input value="{{ $order['shippingAddress']['zipCode'] }}" type="hidden" name="order[shippingAddress][zipCode]">
                                        <input value="{{ $order['shippingAddress']['latitude'] }}" type="hidden" name="order[shippingAddress][latitude]">
                                        <input value="{{ $order['shippingAddress']['longitude'] }}" type="hidden" name="order[shippingAddress][longitude]">
                                        <input value="{{ $order['shippingAddress']['placeId'] }}" type="hidden" name="order[shippingAddress][placeId]">
                                        <input value="{{ $order['shippingAddress']['phone'] }}" type="hidden" name="order[shippingAddress][phone]">

                                    </div>
                                    <div class="card-body">
                                        <div class="col-12">
                                            <div class="mb-1 row">
                                                <div class="col-sm-3"><label class="col-form-label" for="contact-info">Ad</label></div>
                                                <div class="col-sm-9">
                                                    <input value="{{ $order['shippingAddress']['firstName'] }}" type="text" class="form-control" name="order[shippingAddress][firstName]" placeholder="Ad">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="mb-1 row">
                                                <div class="col-sm-3"><label class="col-form-label" for="contact-info">Soyad</label></div>
                                                <div class="col-sm-9">
                                                    <input value="{{ $order['shippingAddress']['lastName'] }}" type="text" class="form-control" name="order[shippingAddress][lastName]" placeholder="Soyad">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="mb-1 row">
                                                <div class="col-sm-3"><label class="col-form-label" for="contact-info">Telefon</label></div>
                                                <div class="col-sm-9">
                                                    <input value="{{ $order['shippingAddress']['phone'] }}" type="text" class="form-control" name="order[shippingAddress][phone]" placeholder="Telefon">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="mb-1 row">
                                                <div class="col-sm-3"><label class="col-form-label" for="contact-info">İl</label></div>
                                                <div class="col-sm-9">
                                                    <select id="shippingAddress-cityId" class="select-with-name form-select" data-nametarget=".select-city" name="order[shippingAddress][cityId]">
                                                        <option value=""> -- </option>
                                                        @if($cities['data'])
                                                            @foreach($cities['data'] as $city)
                                                                @if($city['countryId']==2)
                                                                    <option value="{{ $city['cityId'] }}" @if($order['shippingAddress']['cityId']==$city['cityId']) selected @endif>{{ $city['name'] }}</option>
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                    </select>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="mb-1 row">
                                                <div class="col-sm-3"><label class="col-form-label" for="contact-info">İlçe</label></div>
                                                <div class="col-sm-9">
                                                    <select id="shippingAddress-districtId" class="select-with-name form-select" data-nametarget=".select-district" name="order[shippingAddress][districtId]">
                                                        <option value=""> -- </option>
                                                        @if($cities['data'])
                                                            @foreach($cities['data'] as $city)
                                                                @foreach($city['districts'] as $district)
                                                                    <option class="district-option city-{{ $city['cityId'] }}" value="{{ $district['districtId'] }}" @if($order['shippingAddress']['districtId']==$district['districtId']) selected @endif>{{ $district['name'] }}</option>
                                                                @endforeach
                                                            @endforeach
                                                        @endif
                                                    </select>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="mb-1 row">
                                                <div class="col-sm-3"><label class="col-form-label" for="contact-info">Adres</label></div>
                                                <div class="col-sm-9">
                                                    <textarea name="order[shippingAddress][addressLine1]" class="form-control">{{ $order['shippingAddress']['addressLine1'] }}</textarea>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card full-height mb-4">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <h5 class="card-title m-0">Fatura Bilgileri</h5>
                                        <input value="{{ $order['billingAddress']['customerId'] }}" type="hidden" name="order[billingAddress][customerId]">
                                        <input value="{{ $order['billingAddress']['countryId'] }}" type="hidden" name="order[billingAddress][countryId]" value="2">
                                        <input value="{{ $order['billingAddress']['cityId'] }}" type="hidden" name="order[billingAddress][cityId]">
                                        <input value="{{ $order['billingAddress']['districtId'] }}" type="hidden" name="order[billingAddress][districtId]">
                                        <input value="{{ $order['billingAddress']['firstName'] }}" type="hidden" name="order[billingAddress][firstName]">
                                        <input value="{{ $order['billingAddress']['lastName'] }}" type="hidden" name="order[billingAddress][lastName]">
                                        <input value="" type="hidden" name="order[billingAddress][name]">
                                        <input value="{{ $order['billingAddress']['description'] }}" type="hidden" name="order[billingAddress][description]">
                                        <input value="{{ $order['billingAddress']['addressLine1'] }}" type="hidden" name="order[billingAddress][addressLine1]">
                                        <input value="{{ $order['billingAddress']['addressLine2'] }}" type="hidden" name="order[billingAddress][addressLine2]">
                                        <input value="{{ $order['billingAddress']['country'] }}" type="hidden" name="order[billingAddress][country]">
                                        <input value="{{ $order['billingAddress']['city'] }}" type="hidden" name="order[billingAddress][city]">
                                        <input value="{{ $order['billingAddress']['district'] }}" type="hidden" name="order[billingAddress][district]">
                                        <input value="{{ $order['billingAddress']['zipCode'] }}" type="hidden" name="order[billingAddress][zipCode]">
                                        <input value="{{ $order['billingAddress']['latitude'] }}" type="hidden" name="order[billingAddress][latitude]">
                                        <input value="{{ $order['billingAddress']['longitude'] }}" type="hidden" name="order[billingAddress][longitude]">
                                        <input value="{{ $order['billingAddress']['placeId'] }}" type="hidden" name="order[billingAddress][placeId]">
                                        <input value="{{ $order['billingAddress']['phone'] }}" type="hidden" name="order[billingAddress][phone]">
                                        <input value="{{ $order['billingAddress']['company'] }}" type="hidden" name="order[billingAddress][company]">
                                        <input value="{{ $order['billingAddress']['taxOffice'] }}" type="hidden" name="order[billingAddress][taxOffice]">
                                        <input value="{{ $order['billingAddress']['taxNumber'] }}" type="hidden" name="order[billingAddress][taxNumber]">
                                        <input value="{{ $order['billingAddress']['invoiceType'] }}" type="hidden" name="order[billingAddress][invoiceType]">

                                    </div>
                                    <div class="card-body">
                                        <div class="col-12">
                                            <div class="mb-1 row">
                                                <div class="col-sm-3"><label class="col-form-label" for="contact-info">Ad</label></div>
                                                <div class="col-sm-9">
                                                    <input value="{{ $order['billingAddress']['firstName'] }}" type="text" class="form-control" name="order[billingAddress][firstName]" placeholder="Ad">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="mb-1 row">
                                                <div class="col-sm-3"><label class="col-form-label" for="contact-info">Soyad</label></div>
                                                <div class="col-sm-9">
                                                    <input value="{{ $order['billingAddress']['lastName'] }}" type="text" class="form-control" name="order[billingAddress][lastName]" placeholder="Soyad">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="mb-1 row">
                                                <div class="col-sm-3"><label class="col-form-label" for="contact-info">Telefon</label></div>
                                                <div class="col-sm-9">
                                                    <input value="{{ $order['billingAddress']['phone'] }}" type="text" class="form-control" name="order[billingAddress][phone]" placeholder="Telefon">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="mb-1 row">
                                                <div class="col-sm-3"><label class="col-form-label" for="contact-info">İl</label></div>
                                                <div class="col-sm-9">

                                                    <select id="billingAddress-cityId" class="select-with-name form-select" data-nametarget=".select-city" name="order[billingAddress][cityId]">
                                                        <option value=""> -- </option>
                                                        @if($cities['data'])
                                                            @foreach($cities['data'] as $city)
                                                                @if($city['countryId']==2)
                                                                    <option value="{{ $city['cityId'] }}" @if($order['billingAddress']['cityId']==$city['cityId']) selected @endif>{{ $city['name'] }}</option>
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                    </select>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="mb-1 row">
                                                <div class="col-sm-3"><label class="col-form-label" for="contact-info">İlçe</label></div>
                                                <div class="col-sm-9">
                                                    <select id="billingAddress-districtId" class="select-with-name form-select" data-nametarget=".select-district" name="order[billingAddress][districtId]">
                                                        <option value=""> -- </option>
                                                        @if($cities['data'])
                                                            @foreach($cities['data'] as $city)
                                                                @foreach($city['districts'] as $district)
                                                                    <option class="district-option city-{{ $city['cityId'] }}" value="{{ $district['districtId'] }}" @if($order['billingAddress']['districtId']==$district['districtId']) selected @endif>{{ $district['name'] }}</option>
                                                                @endforeach
                                                            @endforeach
                                                        @endif
                                                    </select>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="mb-1 row">
                                                <div class="col-sm-3"><label class="col-form-label" for="contact-info">Adres</label></div>
                                                <div class="col-sm-9">
                                                  <textarea name="order[billingAddress][addressLine1]" class="form-control">{{ $order['billingAddress']['addressLine1'] }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        @if($order['billingAddress']['invoiceType']=='bireysel')
                                            <div class="col-12">
                                                <div class="mb-1 row">
                                                    <div class="col-sm-3"><label class="col-form-label" for="contact-info">tcKimlik</label></div>
                                                    <div class="col-sm-9">
                                                        <input value="{{ $order['orderCustomer']['tcKimlik'] }}" type="text" class="form-control" name="order[customer][tcKimlik]" placeholder="tcKimlik">
                                                    </div>
                                                </div>
                                            </div>
                                        @elseif($order['billingAddress']['invoiceType']=='kurumsal')
                                            <div class="col-12">
                                                <div class="mb-1 row">
                                                    <div class="col-sm-3"><label class="col-form-label" for="contact-info">company</label></div>
                                                    <div class="col-sm-9">
                                                        <input value="{{ $order['billingAddress']['company'] }}" type="text" class="form-control" name="order[billingAddress][company]" placeholder="company">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="mb-1 row">
                                                    <div class="col-sm-3"><label class="col-form-label" for="contact-info">taxNumber</label></div>
                                                    <div class="col-sm-9">
                                                        <input value="{{ $order['billingAddress']['taxNumber'] }}" type="text" class="form-control" name="order[billingAddress][taxNumber]" placeholder="taxNumber">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="mb-1 row">
                                                    <div class="col-sm-3"><label class="col-form-label" for="contact-info">taxOffice</label></div>
                                                    <div class="col-sm-9">
                                                        <input value="{{ $order['billingAddress']['taxOffice'] }}" type="text" class="form-control" name="order[billingAddress][taxOffice]" placeholder="taxOffice">
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="card mb-4">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="card-title m-0">Sipariş Detayı</h5>
                                <h6 class="m-0"><a href=" javascript:void(0)"><button type="button" class="btn btn-danger btn-popup-form" data-url="{{ route('order.find-product-form') }}"><i class="feather icon-plus"></i></button></a></h6>
                            </div>
                            <div class="card-datatable table-responsive">
                                <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                                    <table class="datatables-order-details table border-top dataTable no-footer dtr-column"
                                           id="order-products" style="width: 802px;">
                                        <thead>
                                        <tr>
                                            <th class="control sorting_disabled dtr-hidden" rowspan="1" colspan="1"
                                                style="width: 0px; display: none;" aria-label=""></th>
                                            <th class="w-50 sorting_disabled" rowspan="1" colspan="1" style="width: 296px;"
                                                aria-label="products">Ürünler
                                            </th>
                                            <th class="w-25 sorting_disabled" rowspan="1" colspan="1" style="width: 124px;"
                                                aria-label="price">Fiyatı
                                            </th>
                                            <th class="w-25 sorting_disabled" rowspan="1" colspan="1" style="width: 115px;"
                                                aria-label="qty">Adeti
                                            </th>
                                            <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 53px;"
                                                aria-label="total">Toplam
                                            </th>
                                            <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 53px;"
                                                aria-label="actions">
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(isset($order['orderProducts']))
                                        @foreach($order['orderProducts'] as $productKey=>$product)
                                                <?php
                                                $variant = \WebService::variant($product['variantId']);
                                                ?>
                                            <tr class="order-items">
                                                <td class="  control" tabindex="0" style="display: none;"></td>
                                                <td class="sorting_1">
                                                    <div class="d-flex justify-content-start align-items-center text-nowrap">
                                                        <div class="avatar-wrapper">
                                                            <div class="avatar me-2"><img src="{{ getProductImageUrl($product['image'], 40,40) }}" class="rounded-2"></div>
                                                        </div>
                                                        <div class="d-flex flex-column"><h6 class="text-body mb-0 text-wrap">{{ $product['name'] }}</h6>
                                                            @if($variant)
                                                                <small class="text-muted">Kodu: {{ $variant['code'] }}</small>
                                                            @endif
                                                            <small class="text-muted">Barkodu: {{ $product['barcode'] }}</small>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td><input class="form-control text-end order-item-price calculate-order" type="number" value="{{ round($product['total']/$product['quantity'], 2) }}" step="0.01"></td>
                                                <td><input class="form-control text-end order-item-quantity calculate-order" type="number" value="{{ $product['quantity'] }}" name="order[orderProducts][{{$productKey}}][quantity]"></td>
                                                <td><input class="form-control disabled text-end order-item-total" type="number"  value="{{ $product['total'] }}" readonly style="min-width: 120px;" name="order[orderProducts][{{$productKey}}][total]" >
                                                <input type="hidden" name="order[orderProducts][{{$productKey}}][productId]" value="{{$product['productId']}}">
                                                <input type="hidden" name="order[orderProducts][{{$productKey}}][variantId]" value="{{$product['variantId']}}">
                                                <input type="hidden" name="order[orderProducts][{{$productKey}}][optionId]" value="{{$product['optionId']}}">
                                                <input type="hidden" name="order[orderProducts][{{$productKey}}][image]" value="{{$product['image']}}">
                                                <input type="hidden" name="order[orderProducts][{{$productKey}}][name]" value="{{$product['name']}}">
                                                <input type="hidden" name="order[orderProducts][{{$productKey}}][barcode]" value="{{$product['barcode']}}">
                                                </td>
                                                <td><button class="btn btn-primary delete-order-item"><i class="feather icon-trash-2"></i></button></td>
                                            </tr>
                                        @endforeach
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                                <div class="d-flex justify-content-end align-items-center m-2 mb-2 p-0">
                                    <div class="order-calculations">
                                        @foreach($order['orderTotals'] as $totalKey=>$total)
                                            <div class="d-flex justify-content-between mb-2">
                                                <span class="w-px-100 text-heading small pe-1">{{ $total['name'] }}</span>
                                                <h6 class="mb-0"><input class="form-control text-end order-totals calculate-order" type="number" step="0.01" data-code="{{ $total['code'] }}" name="order[totals][{{$totalKey}}][value]" value="{{ $total['value'] }}" id="total-{{ $total['code'] }}" /></h6>
                                            </div>
                                            <input type="hidden" name="order[totals][{{$totalKey}}][code]" value="{{ $total['code'] }}" />
                                            <input type="hidden" name="order[totals][{{$totalKey}}][name]" value="{{ $total['name'] }}" />

                                        @endforeach
                                        <div class="d-flex justify-content-between tex-end">
                                            <h6 class="w-px-100 mb-0">Toplam</h6>
                                            <h6 class="mb-0"><input class="form-control text-end" type="number" name="order[orderTotal]" value="{{ $order['orderTotal'] }}" readonly id="orderTotal"/></h6>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        @endif
    </section>
    <!--/ Advanced Search -->
@endsection

@section('vendor-script')
    {{-- vendor files --}}
@endsection

@section('page-script')
<script>
    $('body').on('submit', '#add-product-to-order', function(e){
        e.preventDefault();
        $.ajax( {
            url: $(this).attr('action'),
            method: $(this).attr('method'),
            data: $(this).serialize()
        } ).done(function(response) {
            console.log(response);
            if(response.status){
                $('#order-products tbody').append(response.html);
                calculateOrder();
                //$('body .ajax-form-result').html(response.html);
            }  else {
                //$('body .ajax-form-result').html(response.errors);
            }
        }).fail(function(jqXHR, textStatus, errorThrown) {
            $('body .ajax-form-result').html('Oluşan hatalar için konsola bakınız');
            console.log(jqXHR.responseText);
        })
        return false;
    });
    $('body').on('click', '.delete-order-item', function(){
       $(this).parents('tr').remove();
        calculateOrder();
    });
    $('body').on('change keyup', '.calculate-order', function(){
        calculateOrder();
    });
    function calculateOrder(){
        $('body').find('.order-items').each(function(){
            $(this).find('.order-item-total').val(($(this).find('.order-item-price').val()*$(this).find('.order-item-quantity').val()).toFixed(2));
        });
        let item_total = 0;
        $('body').find('.order-item-total').each(function(){
            item_total += $(this).val()*1;
        });
        $('#total-products').val(item_total.toFixed(2));

        let order_totals = 0;
        $('body').find('.order-totals').each(function(){
            if($(this).data('code')=='discount'){
                order_totals -= $(this).val()*1;
            } else{
                order_totals += $(this).val()*1;
            }
        });
        $('#orderTotal').val(order_totals.toFixed(2));
    }
    $('#shippingAddress-cityId').on('change', function(){
        $('#shippingAddress-districtId').val('');
        $('.district-option').hide();
        $('.district-option.city-' + $(this).val()).show();
    });
    $('#shippingAddress-cityId').change();
    $('#shippingAddress-districtId').val('{{ $order['shippingAddress']['districtId'] }}');

    $('#billingAddress-cityId').on('change', function(){
        $('#billingAddress-districtId').val('');
        $('.district-option').hide();
        $('.district-option.city-' + $(this).val()).show();
    });
    $('#billingAddress-cityId').change();
    $('#billingAddress-districtId').val('{{ $order['billingAddress']['districtId'] }}');

</script>
@endsection
