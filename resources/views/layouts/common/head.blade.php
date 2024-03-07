<head>
    <meta charset="utf-8" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>@yield('title') | Akilliphone Yönetim Paneli</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ _Asset('img/favicon/favicon.ico') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&ampdisplay=swap"
        rel="stylesheet" />

    <link rel="stylesheet" href="{{ _Asset('vendor/fonts/tabler-icons.css') }}" />
    <!-- <link rel="stylesheet" href="{{ _Asset('vendor/fonts/fontawesome.css') }}" /> -->
    <!-- <link rel="stylesheet" href="{{ _Asset('vendor/fonts/flag-icons.css') }}" /> -->

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ _Asset('vendor/css/rtl/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ _Asset('vendor/css/rtl/theme-default.css') }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ _Asset('css/demo.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ _Asset('vendor/libs/node-waves/node-waves.css') }}" />
    <link rel="stylesheet" href="{{ _Asset('vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ _Asset('vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ _Asset('vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ _Asset('vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css') }}">
    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="{{ _Asset('vendor/js/helpers.js') }}"></script>
    <script src="{{ _Asset('js/config.js') }}"></script>

    @include('layouts.common.styles')
</head>
