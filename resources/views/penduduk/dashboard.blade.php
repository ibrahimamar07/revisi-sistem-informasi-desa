@extends('layoutspenduduk.app')

@section('title', 'Dashboard Penduduk - Sistem Informasi Desa')

@section('content')
<div class="pt-4 pb-2 mb-4 border-bottom">
    <h1 class="h2"><i class="fas fa-chart-pie me-2"></i>Dashboard Penduduk</h1>
    <p class="text-muted">Ringkasan informasi data penduduk desa Gumawangrejo.</p>
</div>

<div class="row mb-4">
    <div class="col-md-4">
        <div class="card text-white bg-primary mb-3">
            <div class="card-body">
                <h5 class="card-title"><i class="fas fa-users me-2"></i>Total Penduduk</h5>
                <p class="card-text display-6">{{ $totalPenduduk }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-white bg-info mb-3">
            <div class="card-body">
                <h5 class="card-title"><i class="fas fa-male me-2"></i>Laki-laki</h5>
                <p class="card-text display-6">{{ $lakiLaki }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-white bg-pink mb-3" style="background-color: #e91e63;">
            <div class="card-body">
                <h5 class="card-title"><i class="fas fa-female me-2"></i>Perempuan</h5>
                <p class="card-text display-6">{{ $perempuan }}</p>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h5 class="card-title mb-0">Data Penduduk Terbaru</h5>
    </div>
    <div class="card-body p-0">
        @if($penduduk->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>NIK</th>
                            <th>Nama</th>
                            <th>Jenis Kelamin</th>
                            <th>Alamat & Tanggal Lahir</th>
                            <th>Agama</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($penduduk as $index => $item)
                        <tr>
                            <td>{{ $penduduk->firstItem() + $index }}</td>
                            <td><code>{{ $item->nik }}</code></td>
                            <td>{{ $item->nama }}</td>
                            <td>
                                @if($item->jenis_kelamin === 'L')
                                    <span class="badge bg-primary">Laki-laki</span>
                                @else
                                    <span class="badge bg-pink" style="background-color: #e91e63;">Perempuan</span>
                                @endif
                            </td>
                            <td>{{ $item->alamat_tanggallahir }}</td>
                            <td>{{ $item->agama }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="p-4 text-center">
                <p class="text-muted">Belum ada data penduduk.</p>
            </div>
        @endif
    </div>
    @if($penduduk->hasPages())
    <div class="card-footer">
        {{ $penduduk->links() }}
    </div>
    @endif
</div>
@endsection
