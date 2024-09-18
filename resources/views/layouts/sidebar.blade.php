<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{ route('dashboard') }}" class="brand-link">
        <img src="{{ asset('dist/img/favicons.png') }}" alt="AdminLTE Logo" class="brand-image img-circle"
             style="opacity: .8">
        <span class="brand-text"><b>Laporan</b>Harian</span>
    </a>

    <div class="sidebar">
        <div class="user-panel mt-3 pb-1 mb-3 d-flex border-bottom-0">
            <div class="image">
                <img src="{{ asset('adminLte/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-1"
                     alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block"> {{ auth()->user()->name ?? '' }} </a>
            </div>
        </div>

        <div class="btn-group border-bottom pb-3 d-flex">
            <button onclick="alert('Go to change password page')" class="btn btn-default btn-sm flex-fill"><i
                    class="fas fa-user"></i> User Profile
            </button>
            <form action="{{ route('logout') }}" method="post" class="form-inline flex-fill">
                @csrf
                <button class="btn btn-default btn-sm btn-block"><i class="fas fa-sign-out-alt"></i> Logout</button>
            </form>
        </div>

        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                       aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}"
                       class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }} ">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>

                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <li class="nav-item">
                            {{--                            <a href="{{ route('ik.index') }}"--}}
                            {{--                               class="nav-link {{ request()->routeIs('ik') ? 'active' : '' }} ">--}}
                            {{--                                <i class="nav-icon fas fa-tachometer-alt"></i>--}}
                            {{--                                <p>--}}
                            {{--                                    Instruksi Kerja--}}
                            {{--                                </p>--}}
                            {{--                            </a>--}}
                        </li>

                        @foreach ($menus ?? [] as $menu)
                            <li class="nav-item">
                                <a href="{{ route($menu->url ) }}"
                                   class="nav-link {{ request()->routeIs($menu->url) ? 'active' : '' }} ">
                                    <i class="nav-icon {{ $menu->icon }}"></i>
                                    <p>
                                        {{ $menu->nama_menu }}
                                    </p>
                                </a>
                            </li>
                        @endforeach

                    </ul>
                </nav>
            </ul>
        </nav>
    </div>
</aside>
