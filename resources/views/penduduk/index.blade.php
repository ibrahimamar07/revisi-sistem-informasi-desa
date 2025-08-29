@extends('layoutspenduduk.app')

@section('title', 'Data Penduduk - Sistem Informasi Desa')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2"><i class="fas fa-users me-2"></i>
        @if(Auth::guard('pengguna')->user()->isAdmin())
            Data Penduduk
        @else
            Informasi Penduduk
        @endif
    </h1>
</div>

<div class="card">
    <div class="card-header">
        <div class="row align-items-center">
            <div class="col">
                <h5 class="card-title mb-0">Daftar Penduduk Desa Gumawangrejo</h5>
            </div>
            <div class="col-auto">
                <small class="text-muted">Total: {{ $penduduk->total() }} penduduk</small>
            </div>
        </div>
    </div>
    <div class="card-body p-0">
        @if($penduduk->count() > 0)
            <div class="table-responsive">
                <table class="table table-striped table-hover mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>NIK</th>
                            <th>Nama</th>
                            <th>Jenis Kelamin</th>
                            <th>Alamat & Tanggal Lahir</th>
                            <th>Agama</th>
                            @if(Auth::guard('pengguna')->user()->isAdmin())
                            <th>Aksi</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($penduduk as $index => $item)  
                    <tr>
                        <td>{{ $penduduk->firstItem() + $index }}</td>
                        <td><code class="text-dark">{{ $item->nik }}</code></td>
                        <td><strong>{{ $item->nama }}</strong></td>
                        <td>
                            @if($item->jenis_kelamin == 'L')
                                <span class="badge bg-primary">
                                    <i class="fas fa-male me-1"></i>L
                                </span>
                            @else
                                <span class="badge bg-pink" style="background-color: #e91e63;">
                                    <i class="fas fa-female me-1"></i>P
                                </span>
                            @endif
                        </td>
                        <td>
                            <small class="text-muted">{{ Str::limit($item->alamat_tanggallahir, 20) }}</small>
                        </td>
                        <td>
                            <small class="text-muted">{{ Str::limit($item->agama,10) }}</small>
                        </td>
                        @if(Auth::guard('pengguna')->user()->isAdmin())
                        <td>
                            <div class="btn-group btn-group-sm" role="group">
                                <a href="{{ route('penduduk.show', $item) }}" class="btn btn-outline-info" title="Lihat Detail">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('penduduk.edit', $item) }}" class="btn btn-outline-warning" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form method="POST" action="{{ route('penduduk.destroy', $item) }}" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                        @endif
                    </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
        @else
            <div class="text-center py-5">
                <i class="fas fa-users fa-3x text-muted mb-3"></i>
                <h5 class="text-muted">Belum ada data penduduk</h5>
                <p class="text-muted">
                    @if(Auth::guard('pengguna')->user()->isAdmin())
                        Klik tombol "Tambah Penduduk" untuk menambahkan data baru.
                    @else
                        Belum ada data penduduk yang tersedia.
                    @endif
                </p>
                @if(Auth::guard('pengguna')->user()->isAdmin())
                <a href="{{ route('penduduk.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i>Tambah Penduduk Pertama
                </a>
                @endif
            </div>
        @endif
    </div>
    @if($penduduk->hasPages())
    <div class="card-footer">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <small class="text-muted">
                    Menampilkan {{ $penduduk->firstItem() }} sampai {{ $penduduk->lastItem() }} 
                    dari {{ $penduduk->total() }} data
                </small>
            </div>
            <div>
                {{ $penduduk->links() }}
            </div>
        </div>
    </div>
    @endif
</div>
@endsection