
@extends('layouts/contentLayoutMaster')

@section('title', 'Sipariş Listesi')


@section('page-style')
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
                            <span class="align-middle">Yeni Sipariş</span>
                        </a>
                    </a>
                </div>
              </div>

              <div class="row g-1">
                <div class="col-md-3">

                    <select name="order[paymentTypeId]" id="UserRole" class="form-select text-capitalize mb-md-0 mb-2 datatable-filter">
                        <option value="">Ödeme Tipi</option>
                        @foreach(\Enum::list('PaymentType') as $key=>$val)
                            <option value="{{ $key }}">{{ $val }}</option>
                        @endforeach
                    </select>


                </div>
                <div class="col-md-3">
                    <select name="order[orderStatusId]" id="UserRole" class="form-select text-capitalize mb-md-0 mb-2 datatable-filter">
                        <option value="">Sipariş Durumu</option>
                        @foreach(\Enum::list('OrderStatus') as $key=>$val)
                            <option value="{{ $key }}">{{ $val }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <select name="order[paymentStatusId]" id="UserRole" class="form-select text-capitalize mb-md-0 mb-2 datatable-filter">
                        <option value="">Ödeme Durumu</option>
                        @foreach(\Enum::list('PaymentStatus') as $key=>$val)
                            <option value="{{ $key }}">{{ $val }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control" id="search_product_code" name="search_product_code" placeholder="Ürün Koduna Göre Ara">                </div>
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

@endsection

@section('page-script')
  {{-- Page js files --}}
  <script src="{{ asset(mix('js/scripts/tables/table-datatables-advanced.js')) }}"></script>
@endsection
