
@extends('layouts/contentLayoutMaster')

@section('nav-buttons')
    <a class="btn btn-primary" href="{{ route('order.new') }}">
        <i data-feather="save"></i><span class="align-middle">Yeni Sipariş</span>
    </a>
@endsection
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
