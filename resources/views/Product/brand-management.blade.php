
@extends('layouts/contentLayoutMaster')

@section('title', 'Marka Yönetimi')

@section('page-style')
    {{-- Page Css files --}}
    <link rel="stylesheet" type="text/css" href="{{asset('css/base/plugins/forms/pickers/form-flat-pickr.css')}}">
@endsection

@section('content')
    <section id="advanced-search-datatable">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="col-md-4">
                            <x-button-popup-form :title="'Marka Ekleme'" :text="'Yeni Marka Ekleme'" :url="route('popup', 'BrandSave',)" />
                        </div>

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
    {{-- Page js files --}}
    <script src="{{ asset(mix('js/scripts/tables/table-datatables-advanced.js')) }}"></script>
@endsection
