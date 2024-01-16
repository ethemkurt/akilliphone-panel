
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
            <div class="card-header border-bottom"></div>
          <div class="card-body mt-2">
            <form class="dt_adv_search" method="POST">
              <div class="row g-1 mb-md-1">
                <div class="col-md-4">
                    <x-button-popup-form :title="'Ödeme Durumu'" :text="'Yeni Ödeme Durumu'" :url="route('popup', 'PaymentStatus')" />
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

@endsection

@section('page-script')
  {{-- Page js files --}}
  <script src="{{ asset(mix('js/scripts/tables/table-datatables-advanced.js')) }}"></script>
@endsection
