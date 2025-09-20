@extends('layouts.app')
@section('title', 'Kelola Data Kepala Desa')
@section('page-title', 'Kelola Data Kepala Desa')

@section('page-actions')
<a href="{{ route('admin.kepala-desa.create') }}" class="btn btn-primary">
    <i class="fas fa-plus me-2"></i>Tambah Kepala Desa
</a>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h6 class="m-0 font-weight-bold">
            <i class="fas fa-users me-2"></i>Daftar Kepala Desa
        </h6>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.kepala-desa.index') }}" method="GET" class="mb-3">
</form>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th width="5%">No</th>
                        <th>Nama kepala Desa</th>
                        <th width="15%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($kepalaDesa as $index => $kades)
                        <td>{{ $kepalaDesa->firstItem() + $index }}</td>
                        <td>{{ $kades->nama_kades}}</td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ route('admin.kepala-desa.edit', $kades) }}" 
                                   class="btn btn-sm btn-warning" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.kepala-desa.destroy', $kades) }}" 
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
                        <td colspan="5" class="text-center">Tidak ada data Kepala Desa</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="d-flex justify-content-between align-items-center mt-3">
            <div>
                Menampilkan {{ $kepalaDesa->firstItem() ?? 0 }} sampai {{ $kepalaDesa->lastItem() ?? 0 }} 
                dari {{ $kepalaDesa->total() }} data
            </div>
            {{ $kepalaDesa->links() }}
        </div>
    </div>
</div>
@endsection