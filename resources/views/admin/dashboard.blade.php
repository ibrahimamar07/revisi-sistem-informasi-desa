
@extends('layouts.app')

@if (Auth::guard('pengguna')->user()->role === 'admin')
    @section('title', 'Dashboard Admin')
@section('page-title', 'Dashboard Admin')

@elseif (Auth::guard('pengguna')->user()->role === 'perangkatdesa')
    @section('title', 'Dashboard Perangkat Desa')
    @section('page-title', 'Dashboard perangkat Desa')
@endif


@section('content')
<div class="row mb-4">
    {{-- <div class="col-xl-3 col-md-6 mb-4">
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
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">Total Arsip</div>
                        <div class="h5 mb-0 font-weight-bold">{{ $totalSuratKeluar }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-paper-plane fa-2x text-white-50"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <div class="col-xl-3 col-md-6 mb-4">
        <div class="card stats-card">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">Surat Masuk Bulan Ini</div>
                        <div class="h5 mb-0 font-weight-bold">{{ $suratMasukBulanIni }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar fa-2x text-white-50"></i>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

    <div class="col-xl-6 col-md-6 mb-4">
        <div class="card stats-card">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">Arsip Bulan Ini</div>
                        <div class="h5 mb-0 font-weight-bold">{{ $suratKeluarBulanIni }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-chart-line fa-2x text-white-50"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row justify-content-md-center">
    {{-- <div class="col-lg-6 mb-4">
        <div class="card">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold">
                    <i class="fas fa-inbox me-2"></i>Surat Masuk Terbaru
                </h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>No.Surat</th>
                                <th>Tanggal</th>
                                <th>Perihal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($suratMasukTerbaru as $surat)
                            <tr>
                                <td>{{ $surat->no_surat }}</td>
                                <td>{{ $surat->tanggal->format('d F Y')}}</td>
                                <td>{{ Str::limit($surat->perihalSurat?->deskripsi ?? 'Perihal tidak tersedia', 15) }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center">Tidak ada data</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="text-center">
                    <a href="{{ route('admin.surat-masuk.index') }}" class="btn btn-sm btn-outline-primary">
                        Lihat Semua Surat Masuk
                    </a>
                </div>
            </div>
        </div>
    </div> --}}

    <div class="col-lg-6 mb-4">
        <div class="card">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold">
                    <i class="fas fa-paper-plane me-2"></i>Arsip Terbaru
                </h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>No.Surat</th>
                                <th>Tanggal</th>
                                <th>Perihal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($suratKeluarTerbaru as $surat)
                           <tr>
                                <td>{{ $surat->no_surat }}</td>
                                <td>{{ $surat->tanggal->format('d F Y')}}</td>
                                <td>{{ Str::limit($surat->perihalSurat?->deskripsi ?? 'Perihal tidak tersedia', 15) }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center">Tidak ada data</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                {{-- <div class="text-center">
                    <a href="{{ route('admin.surat-keluar.index') }}" class="btn btn-sm btn-outline-primary">
                        Lihat Semua Arsip
                    </a>
                </div> --}}
            </div>
        </div>
    </div>
</div>



@endsection

