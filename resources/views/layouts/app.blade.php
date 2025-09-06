{{-- resources/views/layouts/app.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Sistem Informasi Surat-Menyurat')</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <style>
        .sidebar {
            min-height: 100vh;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            box-shadow: 2px 0 10px rgba(0,0,0,0.1);
        }
        .sidebar .nav-link {
            color: rgba(255,255,255,0.8);
            padding: 12px 20px;
            margin: 5px 10px;
            border-radius: 8px;
            transition: all 0.3s ease;
        }
        .sidebar .nav-link:hover, .sidebar .nav-link.active {
            background: rgba(255,255,255,0.2);
            color: white;
            transform: translateX(5px);
        }
        .main-content {
            background: #f8f9fa;
            min-height: 100vh;
        }
        .card {
            border: none;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            border-radius: 10px;
        }
        .card-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 10px 10px 0 0 !important;
        }
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
        }
        .btn-primary:hover {
            background: linear-gradient(135deg, #5a6fd8 0%, #6a4190 100%);
        }
        .stats-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 15px;
            transition: transform 0.3s ease;
        }
        .stats-card:hover {
            transform: translateY(-5px);
        }
        .table-responsive {
            border-radius: 10px;
            overflow: hidden;
        }
        .navbar-brand {
            font-weight: bold;
            color: #495057;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-3 col-lg-2 d-md-block sidebar collapse">
                <div class="position-sticky pt-4">
                    <div class="text-center mb-4">
                        <img src="{{ asset('img/profil.jpg') }}" alt="Logo" class="img-fluid" style="max-width: 80px;">
                        <h6 class="text-white mt-2">SISPEMDES</h6>
                        <small class="text-white-50">Pemerintah Desa Gumawangrejo</small>
                    </div>

                    <ul class="nav flex-column">
                        @if(auth()->user()->isAdminPPTK())
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                                    <i class="fas fa-tachometer-alt me-2"></i> Dashboard
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('admin.perihal-surat.*') ? 'active' : '' }}" href="{{ route('admin.perihal-surat.index') }}">
                                    <i class="fas fa-tags me-2"></i> Perihal Surat
                                </a>
                            </li>
                            {{-- <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('admin.surat-masuk.*') ? 'active' : '' }}" href="{{ route('admin.surat-masuk.index') }}">
                                    <i class="fas fa-inbox me-2"></i> Surat Masuk
                                </a>
                            </li> --}}
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('admin.surat-keluar.*') ? 'active' : '' }}" href="{{ route('admin.surat-keluar.index') }}">
                                    <i class="fas fa-paper-plane me-2"></i> Arsip
                                    @if( $permohonanSuratBelumDikonfirmasi > 0)
                                        <span class="badge bg-warning ms-2">{{  $permohonanSuratBelumDikonfirmasi }}</span>
                                         {{-- <span class="badge bg-danger ms-2">{{  $permohonanSuratDitolak }}</span> --}}
                                    @endif

                                     {{-- @if( $permohonanSuratDitolak > 0)
                                         <span class="badge bg-danger ms-2">{{  $permohonanSuratDitolak }}</span>
                                    @endif

                                     @if( $permohonanSuratDisetujui > 0)
                                         <span class="badge bg-success ms-2">{{  $permohonanSuratDisetujui }}</span>
                                    @endif --}}
                                    
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}" href="{{ route('admin.users.index') }}">
                                    <i class="fas fa-users me-2"></i> Kelola Akun
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('laporan.*') ? 'active' : '' }}" href="{{ route('laporan.index') }}">
                                    <i class="fas fa-chart-bar me-2"></i> Laporan
                                </a>
                            </li>
                            <li class="nav-item">
                            <form id="logout-form" method="POST" action="{{ route('logout') }}" class="d-inline">
                                @csrf
                                <button type="submit" class="nav-link w-100 text-start border-0 bg-transparent" onclick="return confirmLogout(event)">
                                    <i class="fas fa-sign-out-alt me-2"></i> Keluar
                                </button>
                            </form>
                        </li>
                        {{-- pendidik --}}
                        @else
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('tenaga-pendidik.dashboard') ? 'active' : '' }}" href="{{ route('tenaga-pendidik.dashboard') }}">
                                    <i class="fas fa-tachometer-alt me-2"></i> Dashboard
                                </a>
                            </li>
                            {{-- <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('tenaga-pendidik.surat-masuk.*') ? 'active' : '' }}" href="{{ route('tenaga-pendidik.surat-masuk.index') }}">
                                    <i class="fas fa-inbox me-2"></i> Surat Masuk
                                </a>
                            </li> --}}
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('tenaga-pendidik.surat-keluar.*') ? 'active' : '' }}" href="{{ route('tenaga-pendidik.surat-keluar.index') }}">
                                    <i class="fas fa-inbox me-2"></i> Permohonan Surat
                                     @if( $permohonanSuratDitolak > 0)
                                         <span class="badge bg-danger ms-2">{{  $permohonanSuratDitolak }}</span>
                                    @endif
                                    @if( $permohonanSuratDisetujui > 0)
                                         <span class="badge bg-success ms-1">{{  $permohonanSuratDisetujui }}</span>
                                    @endif
                                   
                                </a>
                            </li>
                                {{-- <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('laporan.*') ? 'active' : '' }}" href="{{ route('laporan.index') }}">
                                        <i class="fas fa-chart-bar me-2"></i> Laporan
                                    </a>
                                </li> --}}
                           <li class="nav-item ">
                            <form id="logout-form" method="POST" action="{{ route('logout') }}" class="d-inline">
                                @csrf
                                <button type="submit" class="nav-link w-100 text-start border-0 bg-transparent " onclick="return confirmLogout(event)">
                                    <i class="fas fa-sign-out-alt me-2"></i> Keluar
                                </button>
                            </form>
                        </li>
                        @endif
                    </ul>


                    <hr class="text-white-50">

                    <div class="">
                        <a href="" class="d-flex align-items-center text-white text-decoration-none fixed-bottom mb-3 ms-3 " id="dropdownUser1" data-bs-toggle="">
                            <img src="{{ asset('img/profil.jpg') }}" alt="" width="32" height="32" class="rounded-circle me-2">
                            <strong>{{ auth()->user()->name }}</strong>
                        </a>
                        </ul>
                    </div>
                </div>
            </nav>

            <!-- Main content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
                <!-- Top navbar -->
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">@yield('page-title', 'Dashboard')</h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <div class="btn-group me-2">
                            @yield('page-actions')
                        </div>
                    </div>
                </div>

                <!-- Alerts -->
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <!-- Content -->
                @yield('content')
            </main>
        </div>
    </div>

    <script>
    function confirmLogout(event) {
        event.preventDefault();

        swal({
            title: "Yakin ingin keluar?",
            text: "Anda akan keluar dari sesi saat ini.",
            icon: "warning",
            buttons: ["Batal", "Keluar"],
            dangerMode: true,
        }).then((willLogout) => {
            if (willLogout) {
                document.getElementById('logout-form').submit();
            }
        });

        return false;
    }
</script>


    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    @stack('scripts')
</body>
</html>
