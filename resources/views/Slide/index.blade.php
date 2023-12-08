
@extends('layouts/contentLayoutMaster')

@section('title', 'Slaytlar')

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
                    <div class="card-header">
                        <h4 class="card-title">Slaytlar Listesi</h4>
                        <div class="d-flex align-items-center">
                            <p class="card-text font-small-2 me-25 mb-0"></p>
                        </div>
                    </div>
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
