
@extends('layouts/contentLayoutMaster')
@section('nav-buttons')
    <?php
    if($category){
        $title = 'Yeni '.$category['name'].' Kategorisi';
        $parentId = $category['categoryId'];
    } else {
        $title = 'Yeni Kategori';
        $parentId = 0;
    }
    ?>
    <x-button-popup-form :title="$title" :text="'Yeni Kategori'" :url="route('category.edit', ['categoryId'=>'new', 'parentId'=>$parentId])" />

@endsection
@if($category)
    @section('title')
{{$category['name']}} <a class="btn waves-effect p-0 ms-1" href="{{ route('category.child', $category['parentId']?$category['parentId']:'parent') }}"><i class="feather  icon-corner-down-left"></i></a>
    @endsection
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
