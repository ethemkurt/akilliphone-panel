
@extends('layouts/contentLayoutMaster')
@section('nav-buttons')
    <x-button-popup-form :title="'Kategori Ekleme'" :text="'Yeni Kategori Ekleme'" :url="route('popup', 'CategoriesSave',)" />
@endsection
@if($category)
    @section('title', $category['name'])
@else
    @section('title', 'Kategori Yönetimi')
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
