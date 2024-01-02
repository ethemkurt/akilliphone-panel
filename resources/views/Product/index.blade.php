@extends('layouts/contentLayoutMaster')

@section('title', 'Ürün Listesi')

@section('page-style')

@endsection

@section('content')
    <section id="advanced-search-datatable">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <!--Search Form -->
                    <div class="card-body">
                        <form class="dt_adv_search" method="POST">
                            <div class="row g-1 mb-md-1">
                                <div class="col-md-4">
                                    <a href="#">
                                        <a class="btn btn-primary" href="{{ route('product.new') }}">
                                            <i data-feather="save"></i>
                                            <span class="align-middle">Yeni Ürün</span>
                                        </a>
                                    </a>
                                </div>
                            </div>

                            <div class="row g-1">
                                <div class="col-md-3">
                                    <x-inputs.text-input label="Ada Göre Ara" placeholder="Ada Göre Ara" name="search_name" />
                                </div>
                                <div class="col-md-3">
                                    <x-inputs.text-input label="Sipariş No'ya Göre Ara" placeholder="Sipariş No'ya Göre Ara" name="search_order_no" />
                                </div>
                                <div class="col-md-3">
                                    <x-inputs.text-input label="Fatura No'ya Göre Ara" placeholder="Fatura No'ya Göre Ara" name="search_receipt_no" />
                                </div>
                                <div class="col-md-3">
                                    <x-inputs.text-input label="Ürün Koduna Göre Ara" placeholder="Ürün Koduna Göre Ara" name="search_product_code" />
                                </div>
                            </div>
                            <div class="row g-1 mt-1">
                                <div class="col-md-3">
                                    <x-inputs.checkbox-input label="Aktif Ürünler" :checked="'checked'" :id="'search_active_active'" name="search_active" />
                                </div>
                                <div class="col-md-3">
                                    <x-inputs.checkbox-input label="Pasif Ürünler" :id="'search_active_passive'" name="search_active" />
                                </div>
                            </div>
                        </form>
                    </div>
                    <hr class="my-0" />
                    <x-data-table :dataTable="$dataTable"/>
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
