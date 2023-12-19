
@extends('layouts/contentLayoutMaster')

@section('title', 'Hata Logları')

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
                        @if($log)
                            <pre>{{ json_encode($log, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE)  }}</pre>
                        @else
                            Log Bulunamadı
                        @endif
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
