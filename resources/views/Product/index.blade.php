@extends('layouts/contentLayoutMaster')

@section('title', 'Ürün Listesi')

@section('page-style')

@endsection
@section('nav-buttons')
    <a class="btn btn-primary" href="{{ route('product.new','new') }}">
        <i data-feather="save"></i>
        <span class="align-middle">Yeni Ürün</span>
    </a>
@endsection
@section('content')
    <div class="card mb-4">
        <div class="card-widget-separator-wrapper">
            <div class="card-body card-widget-separator">
                <div class="row gy-4 gy-sm-1">
                    <div class="col-sm-6 col-lg-3">
                        <div class="d-flex justify-content-between align-items-start card-widget-1 border-end pb-3 pb-sm-0">
                            <div>
                                <h6 class="mb-2">Mağaza Satışı</h6>
                                <h4 class="mb-2">99.99 TL</h4>
                                <p class="mb-0">
                                    <span class="text-muted me-2">5k sipariş</span><span class="badge bg-label-success">+5.7%</span>
                                </p>
                            </div>
                            <span class="avatar me-sm-4">
                            <span class="avatar-initial bg-label-secondary rounded"><i class="ti-md ti ti-smart-home text-body"></i></span>
                          </span>
                        </div>
                        <hr class="d-none d-sm-block d-lg-none me-4">
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="d-flex justify-content-between align-items-start card-widget-2 border-end pb-3 pb-sm-0">
                            <div>
                                <h6 class="mb-2">Website Satış</h6>
                                <h4 class="mb-2">99.99 TL</h4>
                                <p class="mb-0">
                                    <span class="text-muted me-2">21k sipariş</span><span class="badge bg-label-success">+12.4%</span>
                                </p>
                            </div>
                            <span class="avatar p-2 me-lg-4">
                            <span class="avatar-initial bg-label-secondary rounded"><i class="ti-md ti ti-device-laptop text-body"></i></span>
                          </span>
                        </div>
                        <hr class="d-none d-sm-block d-lg-none">
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="d-flex justify-content-between align-items-start border-end pb-3 pb-sm-0 card-widget-3">
                            <div>
                                <h6 class="mb-2">Pazaryerleri</h6>
                                <h4 class="mb-2">99.99 TL</h4>
                                <p class="mb-0 text-muted">6k sipariş</p>
                            </div>
                            <span class="avatar p-2 me-sm-4">
                            <span class="avatar-initial bg-label-secondary rounded"><i class="ti-md ti ti-gift text-body"></i></span>
                          </span>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h6 class="mb-2">Dropshipping</h6>
                                <h4 class="mb-2">99.99</h4>
                                <p class="mb-0">
                                    <span class="text-muted me-2">150 sipariş</span><span class="badge bg-label-danger">-3.5%</span>
                                </p>
                            </div>
                            <span class="avatar p-2">
                            <span class="avatar-initial bg-label-secondary rounded"><i class="ti-md ti ti-wallet text-body"></i></span>
                          </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section id="advanced-search-datatable">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <!--Search Form -->
                    <div class="card-body">
                        <x-data-table :dataTable="$dataTable"/>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('vendor-script')
    {{-- vendor files --}}
@endsection

@section('page-script')

@endsection
