
@extends('layouts.app')

@section('title', 'Perihal Surat')
@section('page-title', 'Data Perihal Surat')

@section('page-actions')
<a href="{{ route('admin.perihal-surat.create') }}" class="btn btn-primary">
    <i class="fas fa-plus me-2"></i>Tambah Perihal Surat
</a>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h6 class="m-0 font-weight-bold">
            <i class="fas fa-tags me-2"></i>Daftar Perihal Surat
        </h6>
    </div>
    <div class="card-body">
        <form method="GET" action="{{ route('admin.perihal-surat.index') }}" class="mb-3">
    <div class="input-group">
        <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Cari deskripsi perihal...">
        <button class="btn btn-primary" type="submit">
            <i class="fas fa-search"></i> Cari
        </button>
    </div>
</form>

        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th width="5%">No</th>
                        <th>Deskripsi Perihal</th>
                        <th>No surat</th>
                        {{-- <th>Jumlah Surat Masuk</th> --}}
                        <th>Jumlah Permohonan Surat</th>
                        <th>Tanggal Dibuat</th>
                        <th width="15%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($perihalSurat as $index => $perihal)
                    <tr>
                        <td>{{ $perihalSurat->firstItem() + $index }}</td>
                        <td>{{ Str::limit($perihal->deskripsi, 50) }}</td>
                        <td> {{ $perihal->no_surat }} </td>
                        {{-- <td>
                            <span class="badge bg-info">{{ $perihal->surat_masuk_count ?? 0 }}</span>
                        </td> --}}
                        <td>
                            <span class="badge bg-success">{{ $perihal->surat_keluar_count ?? 0 }}</span>
                        </td>
                        <td>{{ $perihal->created_at->format('d/m/Y') }}</td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ route('admin.perihal-surat.show', $perihal) }}" 
                                   class="btn btn-sm btn-info" title="Detail">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.perihal-surat.edit', $perihal) }}" 
                                   class="btn btn-sm btn-warning" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.perihal-surat.destroy', $perihal) }}" 
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
                        <td colspan="6" class="text-center">Tidak ada data perihal surat</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="d-flex justify-content-between align-items-center mt-3">
            <div>
                Menampilkan {{ $perihalSurat->firstItem() ?? 0 }} sampai {{ $perihalSurat->lastItem() ?? 0 }} 
                dari {{ $perihalSurat->total() }} data
            </div>
            {{ $perihalSurat->links() }}
        </div>
    </div>
</div>
@endsection