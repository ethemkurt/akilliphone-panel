
@extends('layouts/contentLayoutMaster')
@section('nav-buttons')
    <x-button-popup-form :title="$option['name'].' Özelliği'" :text="'Yeni '.$option['name']" :url="route('option.value.edit', ['optionId'=>$option['optionId'], 'optionValueId'=>'new'])" />
@endsection

@section('title', $option['name'].' Listesi')

@section('page-style')
    {{-- Page css files --}}
@endsection

@section('content')
    <!-- Dashboard Ecommerce Starts -->
    <section id="settings">
        <div class="row match-height">
            <!-- Statistics Card -->
            <div class="col-12">
                <div class="card card-statistics">
                    <div class="card-body">
                            <x-data-table :dataTable="$dataTable"/>
                    </div>
                </div>
            </div>
            <!--/ Statistics Card -->
        </div>
    </section>
    <!-- Dashboard Ecommerce ends -->
@endsection

@section('vendor-script')
    {{-- vendor files --}}
@endsection
@section('page-script')
    {{-- Page js files --}}
@endsection
