@extends('layoutspenduduk.app')

@section('title', 'Detail Penduduk - Sistem Informasi Desa')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2"><i class="fas fa-user me-2"></i>Detail Penduduk</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">
            @if(Auth::guard('pengguna')->user()->isAdmin())
            <a href="{{ route('penduduk.edit', $penduduk) }}" class="btn btn-warning">
                <i class="fas fa-edit me-2"></i>Edit
            </a>
            @endif
            <a href="{{ route('penduduk.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-2"></i>Kembali
            </a>
        </div>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fas fa-id-card me-2"></i>Informasi Penduduk
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <div class="border-end pe-4">
                            <h6 class="text-muted mb-3">Data Pribadi</h6>
                            
                            <div class="mb-3">
                                <label class="form-label text-muted">NIK</label>
                                <div class="fw-bold fs-5">
                                    <code class="text-dark">{{ $penduduk->nik }}</code>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label text-muted">Nama Lengkap</label>
                                <div class="fw-bold fs-5">{{ $penduduk->nama }}</div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label text-muted">Jenis Kelamin</label>
                                <div>
                                    @if($penduduk->jenis_kelamin == 'L')
                                        <span class="badge bg-primary fs-6">
                                            <i class="fas fa-male me-1"></i>Laki-laki
                                        </span>
                                    @else
                                        <span class="badge fs-6" style="background-color: #e91e63;">
                                            <i class="fas fa-female me-1"></i>Perempuan
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label text-muted">Agama</label>
                                <div class="fw-bold">{{ $penduduk->agama }}</div>
                            </div>
                        </div>
                    </div>

                     <div class="mb-3">
                                <label class="form-label text-muted">Status</label>
                                <div class="fw-bold fs-5">{{ $penduduk->status }}</div>
                            </div>
                        
                        <div class="mb-3">
                            <label class="form-label text-muted">Alamat & Tanggal Lahir</label>
                            <div class="border p-3 rounded bg-light">
                                {{ $penduduk->alamat_tanggallahir }}
                            </div>
                        </div>
                    </div>
                </div>

                <hr>

                <div class="row">
                    <div class="col-12">
                        <h6 class="text-muted mb-3">Informasi Sistem</h6>
                        <div class="row">
                            <div class="col-md-6">
                                <small class="text-muted">Tanggal Dibuat:</small>
                                <div>{{ $penduduk->created_at->format('d F Y, H:i') }} WIB</div>
                            </div>
                            <div class="col-md-6">
                                <small class="text-muted">Terakhir Diupdate:</small>
                                <div>{{ $penduduk->updated_at->format('d F Y, H:i') }} WIB</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if(Auth::guard('pengguna')->user()->isAdmin())
            <div class="card-footer">
                <div class="d-flex justify-content-between">
                    <form method="POST" action="{{ route('penduduk.destroy', $penduduk) }}" 
                          onsubmit="return confirm('Yakin ingin menghapus data penduduk ini? Tindakan ini tidak dapat dibatalkan.')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-trash me-2"></i>Hapus Data
                        </button>
                    </form>
                    
                    <a href="{{ route('penduduk.edit', $penduduk) }}" class="btn btn-warning">
                        <i class="fas fa-edit me-2"></i>Edit Data
                    </a>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection