
@extends('layouts/contentLayoutMaster')
@if($routeName=='user.admin')
    @section('title', 'Personel Listesi')
@elseif($routeName=='user.bayi')
    @section('title', 'Bayi Listesi')
@elseif($routeName=='user.uye')
    @section('title', 'Müşteri Listesi')
@else
    @section('title', 'Kullanıcı Listesi')
@endif


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
            <div class="card-header border-bottom"></div>
          <div class="card-body mt-2">
            <form class="dt_adv_search" method="POST">
              <div class="row g-1 mb-md-1">
                <div class="col-md-4">
                    @if($routeName=='user.admin')
                        <x-button-popup-form :title="'Yeni Personel'" :text="'Yeni Personel'" :url="route('popup', 'User')" />
                    @elseif($routeName=='user.bayi')
                        <x-button-popup-form :title="'Yeni Bayi'" :text="'Yeni Bayi'" :url="route('popup', 'User')" />
                    @elseif($routeName=='user.uye')
                        <x-button-popup-form :title="'Yeni Müşteri'" :text="'Yeni Müşteri'" :url="route('popup', 'User')" />
                    @endif
                </div>
              </div>
                <input type="hidden" class="datatable-filter" id="search_route" name="search_route" value="{{ $routeName }}">
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
