
@extends('layouts/contentLayoutMaster')

@section('title', 'Ayarlar')

@section('page-style')
    {{-- Page css files --}}
@endsection

@section('content')
    <!-- Dashboard Ecommerce Starts -->
    <section id="settings">
        <div class="row">
            <div class="col-md-12">
                <ul class="nav nav-pills flex-column flex-md-row mb-2">
                    <li class="nav-item">
                        <a class="nav-link waves-effect waves-light @if($group=='general') active @endif" href="{{ route('settings.general-group', 'general') }}"><i data-feather="settings"></i> Genel</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link waves-effect waves-light @if($group=='local') active @endif" href="{{ route('settings.general-group', 'local') }}"><i data-feather="settings"></i> Bölgesel</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link waves-effect waves-light @if($group=='shipping') active @endif" href="{{ route('settings.general-group', 'shipping') }}"><i data-feather="settings"></i> Kargo</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link waves-effect waves-light @if($group=='mng') active @endif" href="{{ route('settings.general-group', 'mng') }}"><i data-feather="settings"></i> Mng</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="row match-height">

            <!-- Statistics Card -->
            <div class="col-12">
                <div class="card card-statistics">
                    @include("Settings.groups.".$group)
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
