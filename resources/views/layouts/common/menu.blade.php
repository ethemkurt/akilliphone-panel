<!-- Menu -->
<aside id="layout-menu" class="layout-menu-horizontal menu-horizontal menu bg-menu-theme flex-grow-0">
    <div class="container-xxl d-flex h-100">
        <ul class="menu-inner py-1">
            {{-- Foreach menu item starts --}}
            @if (isset($menuData[0]))
                @foreach ($menuData[0]->menu as $menu)
                    <?php
                        if(isset($menu->navheader)) continue;
                    ?>
                    @php
                        $custom_classes = '';
                        if (isset($menu->classlist)) { $custom_classes = $menu->classlist; }
                    @endphp
                    <li class="menu-item {{ $custom_classes }} {{ request()->is($menu->slug .'*') ? 'active' : '' }}">
                        @if(isset($menu->submenu))
                            <a href="javascript:void(0)" class="menu-link menu-toggle">
                                <i class="menu-icon tf-icons ti ti-{{ $menu->icon }}"></i>
                                <div data-i18n="Apps">{{ $menu->name }}</div>
                            </a>
                            <ul class="menu-sub">
                                @foreach($menu->submenu as $submenu)
                                    <li class="menu-item">
                                        <a href="{{isset($submenu->url) ? url($submenu->url):'javascript:void(0)'}}" class="menu-link">
                                            <i class="menu-icon tf-icons ti ti-{{$submenu->icon}}"></i>
                                            <div data-i18n="Blank">{{ $submenu->name }}</div>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <a href="{{isset($submenu->url) ? url($submenu->url):'javascript:void(0)'}}" class="menu-link">
                                <i class="menu-icon tf-icons ti ti-{{ $menu->icon }}"></i>
                                <div data-i18n="Page 1">{{ $menu->name }}</div>
                            </a>
                        @endif
                    </li>
                @endforeach
            @endif
        </ul>
    </div>
</aside>
<!-- / Menu -->
