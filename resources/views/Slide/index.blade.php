@extends('layouts/contentLayoutMaster')
@section('title', 'Slaytlar')
@section('page-style')
    {{-- Page css files --}}
@endsection
@section('content')
    <section id="settings">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
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
@endsection
