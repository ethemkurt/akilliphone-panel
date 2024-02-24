
@extends('layouts/contentLayoutMaster')

@section('nav-buttons')
    <a class="btn btn-primary" href="{{ route('order.new') }}">
        <i class="fa fa-plus"></i> <span class="align-middle">Yeni Sipariş</span>
    </a>
@endsection
@section('title', 'Sipariş Listesi')

@section('page-style')
<link rel="stylesheet" type="text/css" href="{{_Asset('vendor/libs/flatpickr/flatpickr.css')}}">
@endsection

@section('content')
    <div class="card mb-4">
        <div class="card-widget-separator-wrapper">
            <div class="card-body card-widget-separator">
                <div class="row gy-4 gy-sm-1">
                    <div class="col-sm-6 col-lg-3">
                        <div class="d-flex justify-content-between align-items-start card-widget-1 border-end pb-3 pb-sm-0">
                            <div>
                                <h4 class="mb-2">56</h4>
                                <p class="mb-0 fw-medium">{{ OrderStatus::__(OrderStatus::BEKLIYOR)  }}</p>
                            </div>
                            <span class="avatar me-sm-4">
              <span class="avatar-initial bg-label-secondary rounded">
                <i class="ti-md ti ti-calendar-stats text-body"></i>
              </span>
            </span>
                        </div>
                        <hr class="d-none d-sm-block d-lg-none me-4">
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="d-flex justify-content-between align-items-start card-widget-2 border-end pb-3 pb-sm-0">
                            <div>
                                <h4 class="mb-2">12,689</h4>
                                <p class="mb-0 fw-medium">{{ OrderStatus::__(OrderStatus::ONAYLANDI)  }}</p>
                            </div>
                            <span class="avatar p-2 me-lg-4">
              <span class="avatar-initial bg-label-secondary rounded"><i class="ti-md ti ti-checks text-body"></i></span>
            </span>
                        </div>
                        <hr class="d-none d-sm-block d-lg-none">
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="d-flex justify-content-between align-items-start border-end pb-3 pb-sm-0 card-widget-3">
                            <div>
                                <h4 class="mb-2">124</h4>
                                <p class="mb-0 fw-medium">{{ OrderStatus::__(OrderStatus::IPTALEDILDI)  }}</p>
                            </div>
                            <span class="avatar p-2 me-sm-4">
              <span class="avatar-initial bg-label-secondary rounded"><i class="ti-md ti ti-wallet text-body"></i></span>
            </span>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h4 class="mb-2">32</h4>
                                <p class="mb-0 fw-medium">{{ OrderStatus::__(OrderStatus::BASARISIZ)  }}</p>
                            </div>
                            <span class="avatar p-2">
              <span class="avatar-initial bg-label-secondary rounded"><i class="ti-md ti ti-alert-octagon text-body"></i></span>
            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Advanced Search -->
    <div class="card">
        <div class="card-body">

            <x-data-table :dataTable="$dataTable"/>
        </div>
    </div>
  <!--/ Advanced Search -->

@endsection

@section('vendor-script')
{{-- vendor files --}}

@endsection

@section('page-script')
  {{-- Page js files --}}
  <script>
      if ($('.flatpickr-basic').length) {
          $('.flatpickr-basic').flatpickr({
              altInput: true,
              altFormat: 'd.m.Y',
              dateFormat: 'Y-m-d'
          });
      }
  </script>
@endsection
