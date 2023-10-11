
@extends('layouts/contentLayoutMaster')

@section('title', 'Ürün Listesi')

@section('vendor-style')
  {{-- vendor css files --}}
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/responsive.bootstrap5.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/buttons.bootstrap5.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/rowGroup.bootstrap5.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/flatpickr/flatpickr.min.css')) }}">
  <link rel="stylesheet" href="{{ asset('fonts/font-awesome/font-awesome.min.css') }}" />
@endsection

@section('page-style')
{{-- Page Css files --}}
<link rel="stylesheet" type="text/css" href="{{asset('css/base/plugins/forms/pickers/form-flat-pickr.css')}}">
@endsection



@section('content')

    <!-- Advanced Search -->
<section id="advanced-search-datatable">
    <div class="row">
      <div class="col-12">
        <div class="card">
            <div class="card-header border-bottom">

            </div>
          <!--Search Form -->
          <div class="card-body mt-2">
            <form class="dt_adv_search" method="POST">
              <div class="row g-1 mb-md-1">
                <div class="col-md-4">
                    <a href="#">
                    <a class="btn btn-primary" href="{{ route('order.new') }}">
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
            </form>
          </div>
          <hr class="my-0" />
<x-data-table :dataTable="$dataTable"/>
        </div>
      </div>
    </div>
  </section>
  <!--/ Advanced Search -->

@endsection


@section('vendor-script')
{{-- vendor files --}}
  <script src="{{ asset(mix('vendors/js/tables/datatable/jquery.dataTables.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.bootstrap5.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.responsive.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/responsive.bootstrap5.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/datatables.buttons.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.rowGroup.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/pickers/flatpickr/flatpickr.min.js')) }}"></script>
@endsection

@section('page-script')
  {{-- Page js files --}}
  <script src="{{ asset(mix('js/scripts/tables/table-datatables-advanced.js')) }}"></script>
@endsection
