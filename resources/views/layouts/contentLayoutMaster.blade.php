<!DOCTYPE html>
<html lang="tr" class="light-style layout-menu-fixed layout-compact" dir="ltr">
@include('layouts.common.head')
@yield('page-style')
<body>
<!-- Layout wrapper -->
<div class="layout-wrapper layout-navbar-full layout-horizontal layout-without-menu">
    <div class="layout-container">
        @include('layouts.common.header')
        <!-- Layout container -->
        <div class="layout-page">
            <!-- Content wrapper -->
            <div class="content-wrapper">
                @include('layouts.common.menu')
                <!-- Content -->
                <div class="container-xxl flex-grow-1 container-p-y">
                    @yield('content')
                </div>
                <!--/ Content -->
                @include('layouts.common.footer')
            </div>
            <!--/ Content wrapper -->
        </div>
        <!--/ Layout container -->
    </div>
</div>
<!-- Overlay -->
<div class="layout-overlay layout-menu-toggle"></div>
<!-- Drag Target Area To SlideIn Menu On Small Screens -->
<div class="drag-target"></div>
<!--/ Layout wrapper -->
@include('layouts.common.js')
@include('webservice-js')
@yield('dataTable-script')
@yield('editor-script')
@yield('page-script')

</body>
</html>
