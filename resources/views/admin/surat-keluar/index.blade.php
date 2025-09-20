
@extends('layouts.app')

@section('title', 'Arsip')
@section('page-title', 'Data Arsip')

@section('page-actions')
<a href="{{ route('admin.surat-keluar.create') }}" class="btn btn-primary">
    <i class="fas fa-plus me-2"></i>Tambah Arsip
</a>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h6 class="m-0 font-weight-bold">
            <i class="fas fa-paper-plane me-2"></i>Daftar Arsip
        </h6>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.surat-keluar.index') }}" method="GET" class="mb-3">
    <div class="input-group">
        <input type="text" name="q" value="{{ request('q') }}" class="form-control" placeholder="Cari no surat, perihal, tanggal atau pengirim">
        <button class="btn btn-primary" type="submit">
            <i class="fas fa-search me-1"></i> Cari
        </button>
    </div>
    <div class="row g-2">
    <div class="col-md-2">
        <input type="number" name="jumlah_waktu" value="{{ request('jumlah_waktu') }}" 
               class="form-control" placeholder="Misal: 3">
    </div>
    <div class="col-md-2">
        <select name="tipe_waktu" class="form-select">
            <option value="hari" {{ request('tipe_waktu')=='hari' ? 'selected' : '' }}>Hari</option>
            <option value="minggu" {{ request('tipe_waktu')=='minggu' ? 'selected' : '' }}>minggu</option>
            <option value="bulan" {{ request('tipe_waktu')=='bulan' ? 'selected' : '' }}>Bulan</option>
            <option value="tahun" {{ request('tipe_waktu')=='tahun' ? 'selected' : '' }}>Tahun</option>
        </select>
    </div>
    <div class="col-md-2">
        <button class="btn btn-primary w-100" type="submit">
            <i class="fas fa-search me-1"></i> Filter
        </button>
    </div>
</div>

</form>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th width="5%">No</th>
                        <th>No. Surat</th>
                        <th>Tanggal</th>
                        <th>Pengirim</th>
                        <th>Perihal</th>
                        <th>Nama Kepala Desa</th>
                        {{-- <th>File</th> --}}
                        <th>Dibuat Oleh</th>
                        <th width="">Aksi</th>
                        <th width="">Konfirmasi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($suratKeluar as $index => $surat)
                    <tr>
                        <td>{{ $suratKeluar->firstItem() + $index }}</td>
                        <td>{{ $surat->perihalSurat?->no_surat ?? 'no surat belum ada'}}</td>
                        <td>{{ $surat->tanggal->format('d/m/Y') }}</td>
                        <td>{{ $surat->pengirim }}</td>
                       <td>{{ Str::limit($surat->perihalSurat?->deskripsi ?? 'Perihal tidak tersedia', 25) }}</td>
                        {{-- <td>
                            @if($surat->path)
                                <a href="{{ route('admin.surat-keluar.download', $surat) }}" 
                                   class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-download me-1"></i>
                                    {{ Str::limit($surat->file_name, 20) }}
                                </a>
                                <small class="d-block text-muted">{{ $surat->formatted_file_size }}</small>
                            @else
                                <span class="text-muted">Tidak ada file</span>
                            @endif
                        </td> --}}
                          <td>{{ Str::limit($surat->kepalaDesa?->nama_kades ?? 'Kepala Desa Belum di Set', 25) }}</td>
                        <td>{{ $surat->creator?->nama?? 'pembuat tidak tersedia' }}</td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ route('admin.surat-keluar.show', $surat) }}" 
                                   class="btn btn-sm btn-info" title="Detail">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.surat-keluar.edit', $surat) }}" 
                                   class="btn btn-sm btn-warning" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                
                                <!-- Tombol Cetak Surat -->
                                @if($surat->status == 'disetujui')
                                <a href="{{ route('admin.surat-keluar.cetak', $surat) }}" 
                                   class="btn btn-sm btn-success" 
                                   title="Cetak Surat"
                                   target="_blank">
                                    <i class="fas fa-print"></i>
                                </a>
                                @endif
                            </div>
                        </td>
                        <td>
                            <div class="btn-group" role="group">
                                @if($surat->status == 'belum_dikonfirmasi')
                                    <form action="{{ route('admin.approve', $surat) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-success" onclick="return confirm('Yakin ingin menyetujui surat ini?')" title="Setujui">
                                            <i class="fas fa-check"></i>
                                        </button>
                                    </form>

                                    <form action="{{ route('admin.reject', $surat) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menolak surat ini?')" title="Tolak">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </form>
                                @elseif($surat->status == 'disetujui')
                                    <span class="badge bg-success">Disetujui</span>
                                @elseif($surat->status == 'ditolak')
                                    <span class="badge bg-danger">Ditolak</span>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center">Tidak ada data Arsip</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="d-flex justify-content-between align-items-center mt-3">
            <div>
                Menampilkan {{ $suratKeluar->firstItem() ?? 0 }} sampai {{ $suratKeluar->lastItem() ?? 0 }} 
                dari {{ $suratKeluar->total() }} data
            </div>
            {{ $suratKeluar->links() }}
        </div>
    </div>
</div>
@endsection