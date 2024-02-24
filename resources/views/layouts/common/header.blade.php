<!-- Navbar -->
<nav class="layout-navbar navbar navbar-expand-xl align-items-center bg-navbar-theme" id="layout-navbar">
    <div class="container-xxl">
        <div class="navbar-brand app-brand demo d-none d-xl-flex py-0 me-4">
            <a href="index.html" class="app-brand-link gap-2">
                <span class="app-brand-logo demo">
                  <svg xmlns="http://www.w3.org/2000/svg" width="32" height="22" viewBox="0 0 93.397 51.904">
<g id="Group_5758" data-name="Group 5758" transform="translate(-405 -56.096)">
<g id="Group_5757" data-name="Group 5757">
<g id="Group_5756" data-name="Group 5756">
<g id="Group_1619" data-name="Group 1619" transform="translate(405 56.096)">
<path id="Path_2272" data-name="Path 2272" d="M268.928,328.106H195.4a5.651,5.651,0,0,1-5.539-6.773l8.222-40.6a5.651,5.651,0,0,1,5.538-4.53h73.872a5.651,5.651,0,0,1,5.53,6.819l-8.57,40.6A5.651,5.651,0,0,1,268.928,328.106Z" transform="translate(-189.749 -276.202)" fill="#0c9aff" style="isolation: isolate"></path>
<g id="Group_1619-2" data-name="Group 1619" transform="translate(13.511 14.778)" style="isolation: isolate">
<path id="Path_2202" data-name="Path 2202" d="M248.424,238.275h4.285v15.867h-4.286v-1.621a6.64,6.64,0,0,1-4.892,2.028,7.356,7.356,0,0,1-5.617-2.4,8.583,8.583,0,0,1-2.2-6.023,8.27,8.27,0,0,1,2.231-5.908,7.388,7.388,0,0,1,5.589-2.344,6.586,6.586,0,0,1,4.892,2.086Zm-7.036,10.915a3.862,3.862,0,0,0,2.925,1.217,3.789,3.789,0,0,0,2.924-1.245,4.23,4.23,0,0,0,1.187-2.983,4.116,4.116,0,0,0-7.036-2.954,4.188,4.188,0,0,0-1.129,2.954A4.32,4.32,0,0,0,241.388,249.19Z" transform="translate(-235.708 -232.107)" fill="#fff"></path>
<path id="Path_2203" data-name="Path 2203" d="M260.326,255.92l-5.013-6.572-.9.84v5.729h-4.545V233.889h4.545v11.234l5.328-5.066h5.617l-6.949,6.457,7.417,9.406Z" transform="translate(-229.373 -233.889)" fill="#fff"></path>
<path id="Path_2204" data-name="Path 2204" d="M266.36,254.017h-4.547V238.15h4.547Z" transform="translate(-224.03 -231.982)" fill="#fff"></path>
<path id="Path_2205" data-name="Path 2205" d="M271.92,255.92h-4.547V233.889h4.547Z" transform="translate(-221.543 -233.889)" fill="#fff"></path>
<path id="Path_2206" data-name="Path 2206" d="M277.46,255.92h-4.547V233.889h4.547Z" transform="translate(-219.064 -233.889)" fill="#fff"></path>
<path id="Path_2207" data-name="Path 2207" d="M283,254.017h-4.545V238.15H283Z" transform="translate(-216.586 -231.982)" fill="#fff"></path>
</g>
</g>
</g>
</g>
</g>
</svg>
                </span>
                <span class="app-brand-text demo menu-text fw-bold">Panel</span>
            </a>

            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-xl-none">
                <i class="ti ti-x ti-sm align-middle"></i>
            </a>
        </div>

        <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
            <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                <i class="ti ti-menu-2 ti-sm"></i>
            </a>
        </div>

        <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
            <i class="menu-icon tf-icons ti ti-chevron-right"></i><h4 class="py-3 mb-0">@yield('title')</h4>
            <ul class="navbar-nav flex-row align-items-center ms-auto">
                <!-- User -->
                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                    <span class="user-name fw-bolder">
              {{ \Current::user('firstName') }} {{ \Current::user('lastName') }}
          </span>
                </li>
                <li class="nav-item navbar-dropdown dropdown-user dropdown">

                    {!! _ProfileUserAvatar(\Current::user()) !!}
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <a class="dropdown-item" href="#">


                                    <div class="flex-grow-1">
                                        <span class="fw-medium d-block">{{ \Current::user('firstName') }} {{ \Current::user('lastName') }}</span>
                                        <small class="text-muted">Admin</small>
                                    </div>

                            </a>
                        </li>
                        <li>
                            <div class="dropdown-divider"></div>
                        </li>
                        <li>
                            <button class="dropdown-item btn-popup-form" data-url="{{ route('popup', 'User') }}?userId={{ Current::User('id') }}" >
                                <i class="ti ti-user-check me-2 ti-sm"></i>
                                <span class="align-middle">Profilim</span>
                            </button>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">
                                <i class="ti ti-settings me-2 ti-sm"></i>
                                <span class="align-middle">Ayarlarım</span>
                            </a>
                        </li>
                        <li>
                            <div class="dropdown-divider"></div>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('logout') }}">
                                <i class="ti ti-logout me-2 ti-sm"></i>
                                <span class="align-middle">Log Out</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <!--/ User -->
            </ul>
        </div>
    </div>
</nav>
<!-- / Navbar -->
