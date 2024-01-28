@php
$configData = Helper::applClasses();
@endphp
<div
  class="main-menu menu-fixed {{ $configData['theme'] === 'dark' || $configData['theme'] === 'semi-dark' ? 'menu-dark' : 'menu-light' }} menu-accordion menu-shadow"
  data-scroll-to-active="true">
  <div class="navbar-header">
    <ul class="nav navbar-nav flex-row">
      <li class="nav-item me-auto">
        <a class="navbar-brand" href="{{ url('/') }}">
          <span class="brand-logo">
          <svg xmlns="http://www.w3.org/2000/svg" width="50" height="40" viewBox="0 0 93.397 51.904">
  <g id="Group_5758" data-name="Group 5758" transform="translate(-405 -56.096)">
    <g id="Group_5757" data-name="Group 5757">
      <g id="Group_5756" data-name="Group 5756">
        <g id="Group_1619" data-name="Group 1619" transform="translate(405 56.096)">
          <path id="Path_2272" data-name="Path 2272" d="M268.928,328.106H195.4a5.651,5.651,0,0,1-5.539-6.773l8.222-40.6a5.651,5.651,0,0,1,5.538-4.53h73.872a5.651,5.651,0,0,1,5.53,6.819l-8.57,40.6A5.651,5.651,0,0,1,268.928,328.106Z" transform="translate(-189.749 -276.202)" fill="#0c9aff" style="isolation: isolate"/>
          <g id="Group_1619-2" data-name="Group 1619" transform="translate(13.511 14.778)" style="isolation: isolate">
            <path id="Path_2202" data-name="Path 2202" d="M248.424,238.275h4.285v15.867h-4.286v-1.621a6.64,6.64,0,0,1-4.892,2.028,7.356,7.356,0,0,1-5.617-2.4,8.583,8.583,0,0,1-2.2-6.023,8.27,8.27,0,0,1,2.231-5.908,7.388,7.388,0,0,1,5.589-2.344,6.586,6.586,0,0,1,4.892,2.086Zm-7.036,10.915a3.862,3.862,0,0,0,2.925,1.217,3.789,3.789,0,0,0,2.924-1.245,4.23,4.23,0,0,0,1.187-2.983,4.116,4.116,0,0,0-7.036-2.954,4.188,4.188,0,0,0-1.129,2.954A4.32,4.32,0,0,0,241.388,249.19Z" transform="translate(-235.708 -232.107)" fill="#fff"/>
            <path id="Path_2203" data-name="Path 2203" d="M260.326,255.92l-5.013-6.572-.9.84v5.729h-4.545V233.889h4.545v11.234l5.328-5.066h5.617l-6.949,6.457,7.417,9.406Z" transform="translate(-229.373 -233.889)" fill="#fff"/>
            <path id="Path_2204" data-name="Path 2204" d="M266.36,254.017h-4.547V238.15h4.547Z" transform="translate(-224.03 -231.982)" fill="#fff"/>
            <path id="Path_2205" data-name="Path 2205" d="M271.92,255.92h-4.547V233.889h4.547Z" transform="translate(-221.543 -233.889)" fill="#fff"/>
            <path id="Path_2206" data-name="Path 2206" d="M277.46,255.92h-4.547V233.889h4.547Z" transform="translate(-219.064 -233.889)" fill="#fff"/>
            <path id="Path_2207" data-name="Path 2207" d="M283,254.017h-4.545V238.15H283Z" transform="translate(-216.586 -231.982)" fill="#fff"/>
          </g>
        </g>
      </g>
    </g>
  </g>
</svg>


          </span>
          <h3 class="brand-text">Panel</h3>
        </a>
      </li>
      <li class="nav-item nav-toggle">
        <a class="nav-link modern-nav-toggle pe-0" data-toggle="collapse">
          <i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i>
          <i class="d-none d-xl-block collapse-toggle-icon font-medium-4 text-primary" data-feather="disc"
            data-ticon="disc"></i>
        </a>
      </li>
    </ul>
  </div>
  <div class="shadow-bottom"></div>
  <div class="main-menu-content">
    <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
      {{-- Foreach menu item starts --}}
      @if (isset($menuData[0]))
        @foreach ($menuData[0]->menu as $menu)
          @if (isset($menu->navheader))
            <li class="navigation-header">
              <span>{{$menu->navheader }}</span>
              <i data-feather="more-horizontal"></i>
            </li>
          @else
            {{-- Add Custom Class with nav-item --}}
            @php
              $custom_classes = '';
              if (isset($menu->classlist)) {
                  $custom_classes = $menu->classlist;
              }
            @endphp
            <li
              class="nav-item {{ $custom_classes }} {{ request()->is($menu->slug .'*') ? 'active open' : '' }}">
              <a href="{{ isset($menu->url) ? url($menu->url) : 'javascript:void(0)' }}" class="d-flex align-items-center"
                target="{{ isset($menu->newTab) ? '_blank' : '_self' }}">
                <i data-feather="{{ $menu->icon }}"></i>
                <span class="menu-title text-truncate">{{ $menu->name }}</span>
                @if (isset($menu->badge))
                  <?php $badgeClasses = 'badge rounded-pill badge-light-primary ms-auto me-1'; ?>
                  <span
                    class="{{ isset($menu->badgeClass) ? $menu->badgeClass : $badgeClasses }}">{{ $menu->badge }}</span>
                @endif
              </a>
              @if (isset($menu->submenu))
                @include('panels/submenu', ['menu' => $menu->submenu])
              @endif
            </li>
          @endif
        @endforeach
      @endif
      {{-- Foreach menu item ends --}}
    </ul>
  </div>
</div>
<!-- END: Main Menu-->
