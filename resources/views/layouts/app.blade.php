<!doctype html>
<html lang="en">
<!--begin::Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>@yield('title', 'SIPINTER')</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('images/sipinter-icon.ico') }}">

    <!--begin::Accessibility Meta Tags-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes" />
    <meta name="color-scheme" content="light dark" />
    <meta name="theme-color" content="#007bff" media="(prefers-color-scheme: light)" />
    <meta name="theme-color" content="#1a1a1a" media="(prefers-color-scheme: dark)" />
    <!--end::Accessibility Meta Tags-->

    <!--begin::Primary Meta Tags-->
    {{-- <meta name="title" content="AdminLTE v4 | Dashboard" />
    <meta name="author" content="ColorlibHQ" />
    <meta name="description"
        content="AdminLTE is a Free Bootstrap 5 Admin Dashboard, 30 example pages using Vanilla JS. Fully accessible with WCAG 2.1 AA compliance." />
    <meta name="keywords"
        content="bootstrap 5, bootstrap, bootstrap 5 admin dashboard, bootstrap 5 dashboard, bootstrap 5 charts, bootstrap 5 calendar, bootstrap 5 datepicker, bootstrap 5 tables, bootstrap 5 datatable, vanilla js datatable, colorlibhq, colorlibhq dashboard, colorlibhq admin dashboard, accessible admin panel, WCAG compliant" /> --}}
    <!--end::Primary Meta Tags-->

    <!--begin::Accessibility Features-->
    <!-- Skip links will be dynamically added by accessibility.js -->
    <meta name="supported-color-schemes" content="light dark" />
    {{-- <link rel="preload" href="{{ asset('admin-lte/dist/css/adminlte.min.css') }}" as="style" /> --}}
    <!--end::Accessibility Features-->


    <!--begin::Required Plugin(AdminLTE)-->
    <link rel="stylesheet" href="{{ asset('admin-lte/dist/css/adminlte.min.css') }}" />
    <!--end::Required Plugin(AdminLTE)-->
    @vite(['resources/css/admin.css', 'resources/js/admin.js'])

    @stack('styles')
</head>
<!--end::Head-->
<!--begin::Body-->

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <!--begin::App Wrapper-->
    <div class="app-wrapper">
        <!--begin::Header-->
        <nav class="app-header navbar navbar-expand bg-body">
            <!--begin::Container-->
            <div class="container-fluid">
                <!--begin::Start Navbar Links-->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
                            <i class="bi bi-list"></i>
                        </a>
                    </li>
                </ul>
                <!--end::Start Navbar Links-->

                <!--begin::End Navbar Links-->
                <ul class="navbar-nav ms-auto">

                    <!--begin::Color Mode Toggle (#6010)-->
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="#" id="bd-theme" aria-label="Toggle color scheme"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-sun-fill" data-lte-theme-icon="light"></i>
                            <i class="bi bi-moon-fill d-none" data-lte-theme-icon="dark"></i>
                            <i class="bi bi-circle-half d-none" data-lte-theme-icon="auto"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="bd-theme"
                            style="--bs-dropdown-min-width: 8rem">
                            <li>
                                <button type="button" class="dropdown-item d-flex align-items-center"
                                    data-bs-theme-value="light" aria-pressed="false">
                                    <i class="bi bi-sun-fill me-2"></i>
                                    Light
                                    <i class="bi bi-check-lg ms-auto d-none"></i>
                                </button>
                            </li>
                            <li>
                                <button type="button" class="dropdown-item d-flex align-items-center"
                                    data-bs-theme-value="dark" aria-pressed="false">
                                    <i class="bi bi-moon-fill me-2"></i>
                                    Dark
                                    <i class="bi bi-check-lg ms-auto d-none"></i>
                                </button>
                            </li>
                            <li>
                                <button type="button" class="dropdown-item d-flex align-items-center active"
                                    data-bs-theme-value="auto" aria-pressed="true">
                                    <i class="bi bi-circle-half me-2"></i>
                                    Auto
                                    <i class="bi bi-check-lg ms-auto d-none"></i>
                                </button>
                            </li>
                        </ul>
                    </li>
                    <!--end::Color Mode Toggle-->

                    <!--begin::User Menu Dropdown-->
                    <li class="nav-item dropdown user-menu">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            @if (Auth::user()->avatar)
                                <img src="{{ Auth::user()->avatar }}" class="user-image rounded-circle shadow"
                                    alt="Avatar" />
                            @else
                                <img src="{{ asset('images/default-user.jpg') }}"
                                    class="user-image rounded-circle shadow" alt="Default Avatar" />
                            @endif
                            <span class="d-none d-md-inline">{{ Auth::user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                            <!--begin::User Image-->
                            <li class="user-header text-bg-primary">
                                @if (Auth::user()->avatar)
                                    <img src="{{ Auth::user()->avatar }}" class="rounded-circle shadow"
                                        alt="Avatar" />
                                @else
                                    <img src="{{ asset('images/default-user.jpg') }}" class="rounded-circle shadow"
                                        alt="Default Avatar" />
                                @endif
                                <p>
                                    {{ Auth::user()->name }}
                                    <small>{{ Auth::user()->role }}</small>
                                </p>
                            </li>
                            <!--end::User Image-->
                            <!--begin::Menu Footer-->
                            <li class="user-footer">
                                <a href="{{ route('dashboard.profile') }}" class="btn btn-outline-secondary">
                                    <i class="bi bi-person me-1"></i> Profil
                                </a>
                            </li>
                            <li class="user-footer border-top" style="border-color: #DDE7EF !important;">
                                <form action="{{ route('logout') }}" method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-danger w-100">
                                        <i class="bi bi-box-arrow-right me-1"></i> Keluar
                                    </button>
                                </form>
                            </li>
                            <!--end::Menu Footer-->
                        </ul>
                    </li>
                    <!--end::User Menu Dropdown-->
                </ul>
                <!--end::End Navbar Links-->
            </div>
            <!--end::Container-->
        </nav>
        <!--end::Header-->
        <!--begin::Sidebar-->
        <aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
            <!--begin::Sidebar Brand-->
            <div class="sidebar-brand">
                <!--begin::Brand Link-->
                <a href="{{ route('dashboard.index') }}" class="brand-link sidebar-brand-logo">
                    <img src="{{ asset('images/sipinter-logo.png') }}" alt="SIPINTER" height="40">
                    <span class="brand-text fw-light">SIPINTER</span>
                </a>
                <!--end::Brand Link-->
            </div>
            <!--end::Sidebar Brand-->
            <!--begin::Sidebar Wrapper-->
            <div class="sidebar-wrapper">
                <nav class="mt-2">

                    <!--begin::Sidebar Menu-->
                    <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="navigation"
                        aria-label="Main navigation" data-accordion="false" id="navigation">
                        @php
                            $role = auth()->user()->role;
                        @endphp

                        @if ($role === 'admin')
                            <li class="nav-item">
                                <a href="{{ route('dashboard.index') }}" class="nav-link">
                                    <i class="nav-icon bi bi-speedometer2"></i>
                                    <p>Dashboard</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('dashboard.users.index') }}" class="nav-link">
                                    <i class="nav-icon bi bi-people"></i>
                                    <p>Kelola User</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('dashboard.tingkat-kesulitan.index') }}" class="nav-link">
                                    <i class="nav-icon bi bi-layers"></i>
                                    <p>Kelola Tingkat Kesulitan</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('dashboard.kategori.index') }}" class="nav-link">
                                    <i class="nav-icon bi bi-tags"></i>
                                    <p>Kelola Kategori Materi</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('dashboard.materi.index') }}" class="nav-link">
                                    <i class="nav-icon bi bi-book"></i>
                                    <p>Kelola Materi</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('dashboard.quiz.index') }}" class="nav-link">
                                    <i class="nav-icon bi bi-pencil-square"></i>
                                    <p>Kelola Quiz</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('dashboard.laporan') }}" class="nav-link">
                                    <i class="nav-icon bi bi-file-text"></i>
                                    <p>Laporan</p>
                                </a>
                            </li>
                        @elseif ($role === 'guru')
                            <li class="nav-item">
                                <a href="{{ route('dashboard.index') }}" class="nav-link">
                                    <i class="nav-icon bi bi-speedometer2"></i>
                                    <p>Dashboard</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('dashboard.materi.index') }}" class="nav-link">
                                    <i class="nav-icon bi bi-book"></i>
                                    <p>Kelola Materi</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('dashboard.quiz.index') }}" class="nav-link">
                                    <i class="nav-icon bi bi-pencil-square"></i>
                                    <p>Kelola Quiz</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('dashboard.hasil-siswa') }}" class="nav-link">
                                    <i class="nav-icon bi bi-bar-chart"></i>
                                    <p>Hasil Siswa</p>
                                </a>
                            </li>
                        @endif
                    </ul>
                    <!--end::Sidebar Menu-->
                </nav>
            </div>
            <!--end::Sidebar Wrapper-->
        </aside>
        <!--end::Sidebar-->
        <!--begin::App Main-->
        <main class="app-main">
            <!--begin::App Content Header-->
            <div class="app-content-header">
                <!--begin::Container-->
                <div class="container-fluid">
                    <!--begin::Row-->
                    <div class="row">
                        <div class="col-sm-6">
                            <h3 class="mb-0">@yield('title', 'EduGrow')</h3>
                        </div>
                    </div>
                    <!--end::Row-->
                </div>
                <!--end::Container-->
            </div>
            <!--end::App Content Header-->
            <!--begin::App Content-->
            <div class="app-content">
                {{-- Content yield --}}
                @yield('content')
                {{-- end::Content yield --}}
            </div>
            <!--end::App Content-->
        </main>
        <!--end::App Main-->
        <!--begin::Footer-->
        <footer class="app-footer">
            <!--begin::To the end-->
            <div class="float-end d-none d-sm-inline">Anything you want</div>
            <!--end::To the end-->
            <!--begin::Copyright-->
            &copy; 2026 SIPINTER
            <!--end::Copyright-->
        </footer>
        <!--end::Footer-->
    </div>
    <!--end::App Wrapper-->
    <!--begin::Script-->
    <!--begin::Required Plugin(AdminLTE)-->
    <script src="{{ asset('admin-lte/dist/js/adminlte.min.js') }}"></script>
    <!--end::Required Plugin(AdminLTE)-->

    <!--end::Script-->

    <!--begin::jQuery Stub until Vite admin.js loads-->
    <script>
        window._$q = [];
        window.$ = window.jQuery = function(s) {
            if (typeof s === 'function') {
                window._$q.push(s);
                return document;
            }
            return {
                ready: function(fn) {
                    window._$q.push(fn);
                    return this;
                },
                DataTable: function() {
                    return null;
                },
            };
        };
        window.jQuery.fn = {};
        window.jQuery.ready = function(fn) {
            window._$q.push(fn);
        };
    </script>
    <!--end::jQuery Stub-->

    @stack('scripts')
</body>
<!--end::Body-->

</html>
