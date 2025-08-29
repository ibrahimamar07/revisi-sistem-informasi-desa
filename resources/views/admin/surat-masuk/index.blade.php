
@extends('layouts.app')

@section('title', 'Surat Masuk')
@section('page-title', 'Data Surat Masuk')

@section('page-actions')
<a href="{{ route('admin.surat-masuk.create') }}" class="btn btn-primary">
    <i class="fas fa-plus me-2"></i>Tambah Surat Masuk
</a>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h6 class="m-0 font-weight-bold">
            <i class="fas fa-inbox me-2"></i>Daftar Surat Masuk
        </h6>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.surat-masuk.index') }}" method="GET" class="mb-3">
    <div class="input-group">
        <input type="text" name="q" value="{{ request('q') }}" class="form-control" placeholder="Cari no surat, perihal, atau tanggal...">
        <button class="btn btn-primary" type="submit">
            <i class="fas fa-search me-1"></i> Cari
        </button>
    </div>
</form>

        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th width="5%">No</th>
                        <th>No. Surat</th>
                        <th>Tanggal</th>
                        <th>Perihal</th>
                        <th>File</th>
                        <th>Dibuat Oleh</th>
                        <th width="15%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($suratMasuk as $index => $surat)
                    <tr>
                        <td>{{ $suratMasuk->firstItem() + $index }}</td>
                        <td>{{ $surat->no_surat }}</td>
                        <td>{{ $surat->tanggal->format('d/m/Y') }}</td>
                        <td>{{ Str::limit($surat->perihalSurat?->deskripsi ?? 'Perihal tidak tersedia', 25) }}</td>
                        <td>
                            @if($surat->path)
                                <a href="{{ route('admin.surat-masuk.download', $surat) }}" 
                                   class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-download me-1"></i>
                                    {{ Str::limit($surat->file_name, 20) }}
                                </a>
                                <small class="d-block text-muted">{{ $surat->formatted_file_size }}</small>
                            @else
                                <span class="text-muted">Tidak ada file</span>
                            @endif
                        </td>
                        <td>{{ $surat->creator?->name?? 'pembuat tidak tersedia' }}</td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ route('admin.surat-masuk.show', $surat) }}" 
                                   class="btn btn-sm btn-info" title="Detail">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.surat-masuk.edit', $surat) }}" 
                                   class="btn btn-sm btn-warning" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.surat-masuk.destroy', $surat) }}" 
                                      method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" 
                                            onclick="return confirm('Yakin ingin menghapus?')" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center">Tidak ada data surat masuk</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="d-flex justify-content-between align-items-center mt-3">
            <div>
                Menampilkan {{ $suratMasuk->firstItem() ?? 0 }} sampai {{ $suratMasuk->lastItem() ?? 0 }} 
                dari {{ $suratMasuk->total() }} data
            </div>
            {{ $suratMasuk->links() }}
        </div>
    </div>
</div>
@endsection
