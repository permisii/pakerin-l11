@extends('layouts.template')

@section('template-content')

    <body class="sidebar-mini control-sidebar-slide-open text-md layout-navbar-fixed layout-fixed">
    <div class="wrapper">

        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                        <i
                            class="fas fa-bars"></i>
                    </a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{ route('dashboard') }}" class="nav-link">Home</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link">About</a>
                </li>
            </ul>
        </nav>

        <aside class="main-sidebar elevation-4 sidebar-light-info">
            <a href="{{ route('dashboard') }}" class="brand-link">
                <img src="{{ asset('adminlte/dist/img/favicons.png') }}" alt="AdminLTE Logo"
                     class="brand-image img-circle"
                     style="opacity: .8">
                <span class="brand-text"><b>Daily</b>Operation</span>
            </a>

            <div class="sidebar">
                <div class="user-panel mt-3 pb-1 mb-3 d-flex border-bottom-0">
                    <div class="image">
                        <img src="{{ asset('adminlte/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-1"
                             alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">{{auth()->user()->name}}</a>
                    </div>
                </div>

                <div class="btn-group btn-block border-bottom pb-3">
                    <a href="{{route('users.show', auth()->user()->id)}}" class="btn btn-default btn-sm"><i
                            class="fas fa-user"></i> User Profile
                    </a>
                    <a href="{{ route('login') }}" class="btn btn-default btn-sm"><i
                            class="fas fa-sign-out-alt"></i> Logout</a>
                </div>

                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <li class="nav-item">
                            <a href="{{ route('dashboard') }}"
                               class="nav-link {{ Request::is('dashboard*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>Dashboard </p>
                            </a>
                        </li>
                        <li class="nav-header">ADMINISTRASI</li>
                        <li class="nav-item">
                            <a href="{{ route('users.index') }}"
                               class="nav-link {{ Request::is('users*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-fw fa-users"></i>
                                <p>User </p>
                            </a>
                        </li>

                        {{--                        <li class="nav-header">DATA INDUK</li>--}}
                        {{--                        <li class="nav-item">--}}
                        {{--                            <a href="{{ route('master.unit.index') }}"--}}
                        {{--                               class="nav-link {{ Request::is('master/unit*') ? 'active' : '' }}">--}}
                        {{--                                <i class="nav-icon fas fa-fw fa-tags"></i>--}}
                        {{--                                <p>Unit </p>--}}
                        {{--                            </a>--}}
                        {{--                        </li>--}}

                        {{--                        <li class="nav-header">OPERASIONAL</li>--}}
                        {{--                        <li class="nav-item">--}}
                        {{--                            <a href="{{ route('operation.instruksikerja.index') }}"--}}
                        {{--                               class="nav-link {{ Request::is('operation/instruksikerja*') ? 'active' : '' }}">--}}
                        {{--                                <i class="nav-icon far fa-fw  fa-calendar-alt"></i>--}}
                        {{--                                <p>Instruksi Kerja </p>--}}
                        {{--                            </a>--}}
                        {{--                        </li>--}}

                        {{--                        <li class="nav-item">--}}
                        {{--                            <a href="{{ route('operation.reporting.index') }}"--}}
                        {{--                               class="nav-link {{ Request::is('operation/reporting*') ? 'active' : '' }}">--}}
                        {{--                                <i class="nav-icon far fa-fw  fa-calendar-alt"></i>--}}
                        {{--                                <p>Daily Report </p>--}}
                        {{--                            </a>--}}
                        {{--                        </li>--}}

                        {{--                        <li class="nav-header">LAPORAN</li>--}}

                        {{--                        <li class="nav-item">--}}
                        {{--                            <a href="{{ route('operation.reporting.index') }}"--}}
                        {{--                               class="nav-link {{ Request::is('laporan/pegawaibulanan*') ? 'active' : '' }}">--}}
                        {{--                                <i class="nav-icon far fa-fw  fa-copy"></i>--}}

                        {{--                                --}}{{-- <i class="far fa-copy"></i> --}}
                        {{--                                <p>Pegawai Perbulan </p>--}}
                        {{--                            </a>--}}
                        {{--                        </li>--}}

                    </ul>
                </nav>
            </div>
        </aside>

        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">{{ $params['title'] ?? '' }} @isset($params['subtitle'])
                                    <small class="text-gray" style="font-size: 70%">| {{ $params['subtitle'] }}</small>
                                @endisset
                            </h1>

                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                @foreach ($breadcrumbs ?? [] as $name => $url)
                                    @if ($url)
                                        <li class="breadcrumb-item"><a href="{{ $url }}">{{ $name }}</a></li>
                                    @else
                                        <li class="breadcrumb-item active">{{ $name }}</li>
                                    @endif
                                @endforeach
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="content">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>
        </div>

        <footer class="main-footer">
            <div class="float-right d-none d-sm-inline">(demo version)</div>
            <strong>Copyright &copy; {{ date('Y') }} <a href="https://pakerin.co.id/">PT. Pakerin</a>.</strong>
            All
            rights reserved.
        </footer>
    </div>
    </body>
@endsection

