
@extends('layouts/contentLayoutMaster')
@section('nav-buttons')
    <x-button-popup-form :title="'Ödeme Durumu'" :text="'Yeni Ödeme Durumu'" :url="route('popup', 'PaymentType')" />
@endsection
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
