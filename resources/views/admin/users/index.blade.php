@extends('layouts.app')
@section('title', 'Kelola Akun')
@section('page-title', 'Kelola Akun Pengguna')

@section('page-actions')
<a href="{{ route('admin.users.create') }}" class="btn btn-primary">
    <i class="fas fa-plus me-2"></i>Tambah Pengguna
</a>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h6 class="m-0 font-weight-bold">
            <i class="fas fa-users me-2"></i>Daftar Pengguna
        </h6>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.users.index') }}" method="GET" class="mb-3">
    <div class="input-group">
        <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Cari nama, username, atau role...">
        <button class="btn btn-primary" type="submit">
            <i class="fas fa-search me-1"></i> Cari
        </button>
    </div>
</form>

        <div class="alert alert-info">
    <i class="fas fa-info-circle me-2"></i>
    Akun yang sedang Anda gunakan saat ini <strong>tidak dapat dihapus</strong> untuk mencegah kehilangan akses.
</div>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th width="5%">No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>No KK</th>
                        <th>NIK</th>
                        <th>role</th>
                        <th width="15%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $index => $user)
                    <tr @if ($user->id === auth()->id()) class="table-primary" @endif>
                        <td>{{ $users->firstItem() + $index }}</td>
                        <td>{{ $user->nama}}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->no_kk }}</td>
                        <td>{{ $user->nik }}</td>
                        <td>{{ ucfirst($user->role) }}</td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ route('admin.users.show', $user) }}" 
                                   class="btn btn-sm btn-info" title="Detail">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.users.edit', $user) }}" 
                                   class="btn btn-sm btn-warning" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                @if($user->id !== auth()->id())
                                <form action="{{ route('admin.users.destroy', $user) }}" 
                                      method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" 
                                            onclick="return confirm('Yakin ingin menghapus?')" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center">Tidak ada data pengguna</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="d-flex justify-content-between align-items-center mt-3">
            <div>
                Menampilkan {{ $users->firstItem() ?? 0 }} sampai {{ $users->lastItem() ?? 0 }} 
                dari {{ $users->total() }} data
            </div>
            {{ $users->links() }}
        </div>
    </div>
</div>
@endsection