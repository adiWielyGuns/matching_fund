<div class="left side-menu">
    <button type="button" class="button-menu-mobile button-menu-mobile-topbar open-left waves-effect">
        <i class="ion-close"></i>
    </button>

    <!-- LOGO -->
    <div class="topbar-left">
        <div class="text-center bg-logo">
            {{-- <a href="index.html" class="logo">Pravara</a> --}}
            <a href="{{ route('home-cms') }}" class="logo"><img src="{{ cms('logo') }}" height="50"
                    alt="logo"></a>
        </div>
    </div>
    <div class="sidebar-user">
        <img src="{{ Auth::user()->image ? Auth::user()->image : asset('assets/cms/images/users/avatar-1.jpg') }}"
            alt="user" class="rounded-circle img-thumbnail mb-1">
        <h6 class="">{{ Auth::user()->name }} </h6>
        <p class=" online-icon text-dark"><i class="mdi mdi-record text-success"></i>online</p>
        <ul class="list-unstyled list-inline mb-0 mt-2">
            {{-- <li class="list-inline-item">
                <a href="#" class="" data-toggle="tooltip" data-placement="top" title="Profile"><i
                        class="dripicons-user text-purple"></i></a>
            </li>
            <li class="list-inline-item">
                <a href="#" class="" data-toggle="tooltip" data-placement="top" title="Settings"><i
                        class="dripicons-gear text-dark"></i></a>
            </li> --}}
            <li class="list-inline-item">
                <form action="{{ route('logout') }}" id="logout" method="POST">@csrf</form>
                <a href="javascript:;" onclick="$('#logout').submit()" class="" data-toggle="tooltip"
                    data-placement="top" title="Log out"><i class="dripicons-power text-danger"></i></a>
            </li>
        </ul>
    </div>

    <div class="sidebar-inner slimscrollleft">

        <div id="sidebar-menu">
            <ul>
                @foreach (titleMenu() as $item)
                    @php
                        $hasFeatureTitle = 0;
                        $checkArray = [];
                        foreach ($item->group_menu->where('status', 1)->sortBy('sequence') as $i1 => $d1) {
                            if ($d1->type == 'Single') {
                                if (count($d1->menu) != 0) {
                                    foreach (
                                        $d1->menu
                                            ->where('status', 1)
                                            ->where('slug', $d1->slug)
                                            ->sortBy('sequence')
                                        as $i2 => $d2
                                    ) {
                                        if (Auth::user() != null) {
                                            if (Auth::user()->aksesMenu('view', $d2->slug)) {
                                                $hasFeatureTitle++;
                                            }
                                        }
                                    }
                                } else {
                                    $hasFeatureTitle++;
                                }
                            } else {
                                foreach ($d1->menu->where('status', 1)->sortBy('sequence') as $i2 => $d2) {
                                    if (Auth::user() != null) {
                                        if (Auth::user()->aksesMenu('view', $d2->slug)) {
                                            array_push($checkArray, $d2->slug);
                                            $hasFeatureTitle++;
                                        }
                                    }
                                }
                            }
                        }
                    @endphp

                    @if ($hasFeatureTitle != 0)
                        <li class="menu-title">{{ $item->name }}</li>
                        @foreach ($item->group_menu->where('status', 1)->sortBy('sequence') as $item1)
                            @if ($item1->type == 'Single')
                                @if (count($item1->menu) != 0)
                                    <li>
                                        <a href="{{ route($item1->slug) }}"
                                            class="waves-effect {{ Request::segment(1) == $item1->slug ? 'active' : '' }}">
                                            <i class="{{ $item1->icon }}"></i>
                                            <span class="inline-block">{{ $item1->name }}</span>
                                        </a>
                                    </li>
                                @else
                                    <li>
                                        <a href="{{ route($item1->slug) }}"
                                            class="waves-effect {{ Request::segment(1) == $item1->slug ? 'active' : '' }}">
                                            <i class="dripicons-device-desktop"></i>
                                            <span class="inline-block"> Error No Menu</span>
                                        </a>
                                    </li>
                                @endif
                            @elseif ($item1->type == 'Dropdown')
                                @php
                                    $hasFeatureGroup = 0;
                                    foreach (
                                        $item1->menu
                                            ->where('status', 1)
                                            ->where('type', 'Menu')
                                            ->sortBy('sequence')
                                        as $i2 => $d2
                                    ) {
                                        if (Auth::user() != null) {
                                            if (Auth::user()->aksesMenu('view', $d2->slug)) {
                                                array_push($checkArray, $d2->slug);
                                                $hasFeatureGroup++;
                                            }
                                        }
                                    }
                                @endphp
                                @if (count($item1->menu) != 0)
                                    @if ($hasFeatureGroup != 0)
                                        <li
                                            class="has_sub {{ Request::segment(1) == $item1->slug ? 'active nav-active' : '' }}">
                                            <a href="javascript:void(0);"
                                                class="waves-effect {{ Request::segment(1) == $item1->slug ? 'active' : '' }}">
                                                <i class="{{ $item1->icon }}"></i>
                                                <span class="d-inline-block"
                                                    style="width: 70%">{{ $item1->name }}</span>
                                                <span class="float-right">
                                                    <i class="mdi mdi-chevron-right"></i>
                                                </span>
                                            </a>
                                            @php
                                                $menu = $item1->menu
                                                    ->where('status', 1)
                                                    ->where('type', 'Menu')
                                                    ->sortBy('sequence');
                                            @endphp
                                            <ul class="list-unstyled">
                                                @foreach ($item1->menu as $item3)
                                                    <li
                                                        class="{{ Request::segment(2) == $item3->slug ? 'active' : '' }}">
                                                        <a href="{{ route($item3->slug) }}">{{ $item3->name }}</a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </li>
                                    @endif
                                @endif
                            @endif
                            {{-- @foreach ($item->group_menu as $item)

                        @endforeach --}}
                        @endforeach
                    @endif
                @endforeach

            </ul>
        </div>
        <div class="clearfix"></div>
    </div> <!-- end sidebarinner -->
</div>
