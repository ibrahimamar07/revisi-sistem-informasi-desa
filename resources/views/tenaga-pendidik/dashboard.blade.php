
@extends('layouts.app')

@section('title', 'Dashboard Warga')
@section('page-title', 'Dashboard Warga')

@section('content')
<div class="row justify-content-md-center">
    {{-- <div class="col-xl-6 col-md-6 mb-4">
        <div class="card stats-card">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">Total Surat Masuk</div>
                        <div class="h5 mb-0 font-weight-bold">{{ $totalSuratMasuk }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-inbox fa-2x text-white-50"></i>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

    <div class="col-xl-6 col-md-6 mb-4">
        <div class="card stats-card">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2 items-center">
                        <div class="text-xs font-weight-bold text-uppercase mb-1 text-center ">Total Permohonan Surat</div>
                        <div class="h5 mb-0 font-weight-bold text-center">{{ $totalSuratKeluar }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-paper-plane fa-2x text-white-50"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold">
                    <i class="fas fa-info-circle me-2"></i>Selamat Datang
                </h6>
            </div>
            <div class="card-body text-center py-5">
                <i class="fas fa-user-graduate fa-5x text-primary mb-4"></i>
                <h4>Selamat Datang, {{ auth()->user()->name }}!</h4>
                <p class="text-muted mb-4">
                    Anda login sebagai Warga di Sistem Informasi Surat-Menyurat<br>
                    Pemerintah Desa Gumawangrejo
                </p>
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="alert alert-info">
                            <i class="fas fa-lightbulb me-2"></i>
                            <strong>Tips:</strong> Gunakan menu navigasi di sebelah kiri untuk mengakses fitur-fitur yang tersedia.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
