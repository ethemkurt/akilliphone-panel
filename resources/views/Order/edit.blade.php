
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
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">

                <div class="d-flex flex-column justify-content-center gap-2 gap-sm-0">
                    <h5 class="mb-1 mt-1 d-flex flex-wrap gap-2 align-items-end">Sipariş No #{{ $order['orderId'] }}
                        <span class="badge bg-{{ \PaymentType::color($order['paymentTypeId']) }}">Ödeme Türü: {{ \PaymentType::__($order['paymentTypeId']) }}</span>
                        <span class="badge bg-{{ \OrderStatus::color($order['orderStatusId']) }}">Sipariş Durumu: {{ \OrderStatus::__($order['orderStatusId']) }}</span></h5>
                    <p class="text-body">{{ _HumanDate($order['createdAt'], 'd.m.Y') }}</p>
                </div>
                <div class="d-flex align-content-center flex-wrap gap-2">
                    <a class="btn btn-success edit-order waves-effect" href="{{ route('order.edit', $order['orderId']) }}">Kaydet</a>
                </div>
            </div>
            <form class="form form-horizontal">
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
                                                    <select value="{{ $order['paymentTypeId'] }}" type="text" class="form-control" name="order[paymentTypeId]" placeholder="paymentTypeId">
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="mb-1 row">
                                                <div class="col-sm-3"><label class="col-form-label" for="contact-info">Ödeme Durumu</label></div>
                                                <div class="col-sm-9">
                                                    <select value="{{ $order['paymentStatusId'] }}" type="text" class="form-control" name="order[paymentStatusId]" placeholder="paymentStatusId">
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="mb-1 row">
                                                <div class="col-sm-3"><label class="col-form-label" for="contact-info">Sipariş durumu</label></div>
                                                <div class="col-sm-9">
                                                    <select value="{{ $order['orderStatusId'] }}" type="text" class="form-control" name="order[orderStatusId]" placeholder="orderStatusId">
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
                                    </div>
                                    <div class="card-body">
                                        <div class="col-12">
                                            <div class="mb-1 row">
                                                <div class="col-sm-3"><label class="col-form-label" for="contact-info">Ad</label></div>
                                                <div class="col-sm-9">
                                                    <input value="{{ $order['orderCustomer']['firstName'] }}" type="text" class="form-control" name="order[orderCustomer][firstName]" placeholder="Ad">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="mb-1 row">
                                                <div class="col-sm-3"><label class="col-form-label" for="contact-info">Soyad</label></div>
                                                <div class="col-sm-9">
                                                    <input value="{{ $order['orderCustomer']['lastName'] }}" type="text" class="form-control" name="order[orderCustomer][lastName]" placeholder="Soyad">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="mb-1 row">
                                                <div class="col-sm-3"><label class="col-form-label" for="contact-info">Email</label></div>
                                                <div class="col-sm-9">
                                                    <input value="{{ $order['orderCustomer']['email'] }}" type="text" class="form-control" name="order[orderCustomer][email]" placeholder="Email">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="mb-1 row">
                                                <div class="col-sm-3"><label class="col-form-label" for="contact-info">Telefon</label></div>
                                                <div class="col-sm-9">
                                                    <input value="{{ $order['orderCustomer']['telefon'] }}" type="text" class="form-control" name="order[orderCustomer][telefon]" placeholder="Telefon">
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
                                                    <input value="{{ $order['shippingAddress']['city'] }}" type="text" class="form-control" name="order[shippingAddress][city]" placeholder="İl">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="mb-1 row">
                                                <div class="col-sm-3"><label class="col-form-label" for="contact-info">İlçe</label></div>
                                                <div class="col-sm-9">
                                                    <input value="{{ $order['shippingAddress']['district'] }}" type="text" class="form-control" name="order[shippingAddress][district]" placeholder="İlçe">
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
                                                    <input value="{{ $order['billingAddress']['city'] }}" type="text" class="form-control" name="order[billingAddress][city]" placeholder="İl">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="mb-1 row">
                                                <div class="col-sm-3"><label class="col-form-label" for="contact-info">İlçe</label></div>
                                                <div class="col-sm-9">
                                                    <input value="{{ $order['billingAddress']['district'] }}" type="text" class="form-control" name="order[billingAddress][district]" placeholder="İlçe">
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        @if($order['billingAddress']['invoiceType']=='bireysel')
                                            <div class="col-12">
                                                <div class="mb-1 row">
                                                    <div class="col-sm-3"><label class="col-form-label" for="contact-info">tcKimlik</label></div>
                                                    <div class="col-sm-9">
                                                        <input value="{{ $order['billingAddress']['tcKimlik'] }}" type="text" class="form-control" name="order[billingAddress][tcKimlik]" placeholder="tcKimlik">
                                                    </div>
                                                </div>
                                            </div>
                                        @elseif($order['billingAddress']['invoiceType']=='bireysel')
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
                                <h6 class="m-0"><a href=" javascript:void(0)">Düzenle</a></h6>
                            </div>
                            <div class="card-datatable table-responsive">
                                <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                                    <table class="datatables-order-details table border-top dataTable no-footer dtr-column"
                                           id="DataTables_Table_0" style="width: 802px;">
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
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($order['orderProducts'] as $product)
                                            <tr class="odd">
                                                <td class="  control" tabindex="0" style="display: none;"></td>
                                                <td class="sorting_1">
                                                    <div class="d-flex justify-content-start align-items-center text-nowrap">
                                                        <div class="avatar-wrapper">
                                                            <div class="avatar me-2"><img src="{{ getProductImageUrl($product['image'], 40,40) }}" class="rounded-2"></div>
                                                        </div>
                                                        <div class="d-flex flex-column"><h6 class="text-body mb-0 text-wrap">{{ $product['name'] }}</h6>
                                                            <small class="text-muted">Material: Wooden</small></div>
                                                    </div>
                                                </td>
                                                <td><span>{{ _FormatPrice($product['total']/$product['quantity']) }}</span></td>
                                                <td><span class="text-body">{{ $product['quantity'] }}</span></td>
                                                <td><h6 class="mb-0 text-nowrap">{{ _FormatPrice($product['total']) }}</h6></td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="d-flex justify-content-end align-items-center m-2 mb-2 p-0">
                                    <div class="order-calculations">
                                        @foreach($order['orderTotals'] as $total)
                                            <div class="d-flex justify-content-between mb-2">
                                                <span class="w-px-100 text-heading small pe-1">{{ $total['name'] }}</span>
                                                <h6 class="mb-0">{{ _FormatPrice($total['value']) }}</h6>
                                            </div>
                                        @endforeach
                                        <div class="d-flex justify-content-between tex-end">
                                            <h6 class="w-px-100 mb-0">Toplam</h6>
                                            <h6 class="mb-0">{{_FormatPrice($order['orderTotal'])}}</h6>
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

@endsection
