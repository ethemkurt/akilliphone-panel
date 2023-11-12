
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
            <a class="btn btn-primary edit-order waves-effect" href="{{ route('order.edit', $order['orderId']) }}"><i class="fa fa-edit"></i> Siparişi Düzenle</a>
            <button type="button" class="btn btn-danger  waves-effect waves-float waves-light btn-popup-form" data-bs-toggle="modal" data-bs-target="#poupForm" data-url="{{ route('popup', 'deleteOrder') }}?orderId={{ $order['orderId'] }}"><i class="fa fa-trash"></i> Sipariş Sil</button>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-lg-8">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title m-0">Sipariş Detayı</h5>
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
                                <?php
                                    $variant = \WebService::variant($product['variantId']);
                                    ?>
                                <tr class="odd">
                                    <td class="  control" tabindex="0" style="display: none;"></td>
                                    <td class="sorting_1">
                                        <div class="d-flex justify-content-start align-items-center text-nowrap">
                                            <div class="avatar-wrapper">
                                                <div class="avatar me-2"><img src="{{ getProductImageUrl($product['image'], 40,40) }}" class="rounded-2"></div>
                                            </div>
                                            <div class="d-flex flex-column">
                                                <h6 class="text-body mb-0 text-wrap">{{ $product['name'] }} @if($variant)({{ $variant['name'] }})@endif</h6>
                                                @if($variant)
                                                    <small class="text-muted">Kodu: {{ $variant['code'] }}</small>
                                                @endif
                                                <small class="text-muted">Barkodu: {{ $product['barcode'] }}</small>
                                            </div>
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
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title m-0">Sipariş Geçmişi</h5>
                </div>

                <div class="card-body">
                    <ul class="timeline pb-0 mb-0">
                        <li class="timeline-item timeline-item-transparent">
                            <span class="timeline-point timeline-point-primary"></span>
                            <div class="timeline-event">
                                <div class="timeline-header">
                                    <h6 class="mb-0">Sipariş Oluşturuldu (Sipariş No: #32543)</h6>
                                    <span class="text-muted">{{ _HumanDate(date('Y-m-d')) }}</span>
                                </div>
                                <p class="mt-2">Siparişiniz başarıyla oluşturuldu</p>
                            </div>
                        </li>
                        <li class="timeline-item timeline-item-transparent">
                            <span class="timeline-point timeline-point-primary"></span>
                            <div class="timeline-event">
                                <div class="timeline-header">
                                    <h6 class="mb-0">Sipariş Onaylandı</h6>
                                    <span class="text-muted">{{ _HumanDate(date('Y-m-d')) }}</span>
                                </div>
                                <p class="mt-2">Sipariş onaylanarak işleme alındı</p>
                            </div>
                        </li>
                        <li class="timeline-item timeline-item-transparent">
                            <span class="timeline-point timeline-point-primary"></span>
                            <div class="timeline-event">
                                <div class="timeline-header">
                                    <h6 class="mb-0">Sipariş kargolandı</h6>
                                    <span class="text-muted">{{ _HumanDate(date('Y-m-d')) }}</span>
                                </div>
                                <p class="mt-2">Siaprişiniz Aras Kargoya verildi</p>
                            </div>
                        </li>
                        <li class="timeline-item timeline-item-transparent border-transparent pb-0">
                            <span class="timeline-point timeline-point-secondary"></span>
                            <div class="timeline-event pb-0">
                                <div class="timeline-header">
                                    <h6 class="mb-0">Teslim Edildi</h6>
                                </div>
                                <p class="mt-2 mb-0">Siparişiniz adresinize teslim edildi</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-4">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title m-0">Müşteri Bilgileri</h5>
                </div>
                <div class="card-body">
                    <p class=" mb-1">#{{ $order['orderCustomer']['orderCustomerId'] }}</p>
                    <p class=" mb-1">{{ $order['orderCustomer']['firstName'] }} {{ $order['orderCustomer']['lastName'] }}</p>
                    <p class=" mb-1">{{ $order['orderCustomer']['email'] }}</p>
                    <p class=" mb-1">{{ $order['orderCustomer']['telefon'] }} </p>
                </div>
            </div>
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title m-0">Teslimat Bilgileri</h5>
                </div>
                <div class="card-body">
                    <p class=" mb-1">{{ $order['shippingAddress']['firstName'] }} {{ $order['shippingAddress']['lastName'] }}</p>
                    <p class=" mb-1">{{ $order['shippingAddress']['phone'] }}</p>
                    <p class=" mb-1">{{ $order['shippingAddress']['address'] }} </p>
                    <p class=" mb-1">{{ $order['shippingAddress']['district'] }}/{{ $order['shippingAddress']['city'] }}</p>
                    <p class=" mb-1 fw-bold">{{ $order['shippingAddress']['country'] }}</p>
                </div>
            </div>
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title m-0">Fatura Bilgileri</h5>
                </div>
                <div class="card-body">
                    <p class=" mb-1">{{ $order['billingAddress']['firstName'] }} {{ $order['billingAddress']['lastName'] }}</p>
                    <p class=" mb-1">{{ $order['billingAddress']['phone'] }}</p>
                    <p class=" mb-1">{{ $order['billingAddress']['address'] }} </p>
                    <p class=" mb-1">{{ $order['billingAddress']['district'] }}/{{ $order['billingAddress']['city'] }}</p>
                    <p class=" mb-1 fw-bold">{{ $order['billingAddress']['country'] }}</p>
                    <hr>
                    @if($order['billingAddress']['invoiceType']=='bireysel')
                        <h6 class="m-0 text-info">Bireysel Fatura</h6>
                        <p class=" mb-1">TC Kimlik: {{ $order['billingAddress']['tcKimlik'] }}</p>
                    @elseif($order['billingAddress']['invoiceType']=='bireysel')
                        <h6 class="m-0 text-danger">Kurumsal Fatura</h6>
                        <p class=" mb-1">Firma: {{ $order['billingAddress']['company'] }}}</p>
                        <p class=" mb-1">Vergi No: {{ $order['billingAddress']['taxNumber'] }}}</p>
                        <p class=" mb-1">Vergi Dairesi: {{ $order['billingAddress']['taxOffice'] }}}</p>
                    @else
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endif
</section>
<!--/ Advanced Search -->
@endsection


@section('vendor-script')
{{-- vendor files --}}

@endsection

@section('page-script')

@endsection
