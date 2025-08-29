<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sistem Informasi Desa')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .sidebar {
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            z-index: 100;
            padding: 48px 0 0;
            box-shadow: inset -1px 0 0 rgba(0, 0, 0, .1);
        }
        .sidebar-sticky {
            position: relative;
            top: 0;
            height: calc(100vh - 48px);
            padding-top: .5rem;
            overflow-x: hidden;
            overflow-y: auto;
        }
        .sidebar .nav-link {
            font-weight: 500;
            color: #333;
        }
        .sidebar .nav-link.active {
            color: #007bff;
        }
        .sidebar .nav-link:hover {
            color: #007bff;
        }
        main {
            margin-left: 240px;
        }
        @media (max-width: 767.98px) {
            .sidebar {
                position: relative;
                margin-left: 0;
            }
            main {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>
   @if(Auth::guard('pengguna')->check())
    <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="{{ route('dashboard') }}">
            <i class="fas fa-city me-2"></i>Sistem Desa
        </a>
        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-nav">
            <div class="nav-item text-nowrap">
                <form method="POST" action="{{ route('logoutpenduduk') }}" class="d-inline">
                    @csrf
                    <button type="submit" class="nav-link px-3 btn btn-link text-white">
                        <i class="fas fa-sign-out-alt me-1"></i>Logout
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                <div class="position-sticky pt-3">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                                <i class="fas fa-home me-2"></i>
                                Beranda
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('penduduk.*') ? 'active' : '' }}" href="{{ route('penduduk.index') }}">
                                <i class="fas fa-users me-2"></i>
                               @if(Auth::guard('pengguna')->check() && Auth::guard('pengguna')->user()->isAdmin())
                                    Data Penduduk
                                @else
                                    Informasi Penduduk
                                @endif

                            </a>
                        </li>
                        @if(Auth::guard('pengguna')->check() && Auth::guard('pengguna')->user()->isAdmin())
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('penduduk.create') ? 'active' : '' }}" href="{{ route('penduduk.create') }}">
                                <i class="fas fa-id-card me-2"></i>
                                Pendaftaran Penduduk
                            </a>
                        </li>
                        @endif

                        @if(Auth::guard('pengguna')->check() && Auth::guard('pengguna')->user()->isAdmin())
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('user.profile') ? 'active' : '' }}" href="{{ route('user.profile') }}">
                                <i class="fas fa-user me-2"></i>
                                Akun
                            </a>
                        </li>
                        @endif
                    </ul>
                </div>
            </nav>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>
    @else
        @yield('content')
  @endif

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>