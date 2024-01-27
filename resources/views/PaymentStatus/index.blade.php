
@extends('layouts/contentLayoutMaster')

@section('title', 'Ödeme Durumları Listesi')

@section('page-style')
{{-- Page Css files --}}
@endsection

@section('content')
    <!-- Advanced Search -->
<section id="advanced-search-datatable">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">

              <div class="col-md-4">
                  <x-button-popup-form :title="'Ödeme Durumu'" :text="'Yeni Ödeme Durumu'" :url="route('popup', 'PaymentStatus')" />
              </div>
              <x-data-table :dataTable="$dataTable"/>
          </div>
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
