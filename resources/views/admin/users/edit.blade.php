@extends('layouts.app') 

@section('title', 'Edit Akun')

@section('content')
<div class="container mt-4">
    <h2>Edit Akun</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Terjadi kesalahan!</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Nama Lengkap</label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" name="username" value="{{ old('username', $user->username) }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password Baru <small class="text-muted">(Kosongkan jika tidak ingin mengganti)</small></label>
            <input type="password" name="password" class="form-control">
        </div>

        <div class="mb-3">
            <label for="role" class="form-label">Peran</label>
            <select name="role" class="form-select" required>
                <option value="admin_pptk" {{ old('role', $user->role) === 'admin_pptk' ? 'selected' : '' }}>Admin PPTK</option>
                <option value="tenaga_pendidik" {{ old('role', $user->role) === 'tenaga_pendidik' ? 'selected' : '' }}>Tenaga Pendidik</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
