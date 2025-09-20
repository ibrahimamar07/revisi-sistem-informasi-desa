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
            <label for="nama" class="form-label">Nama</label>
            <input type="text" name="nama" value="{{ old('nama', $user->nama) }}" class="form-control" required>
        </div>
        
        {{-- <div class="mb-3">
            <label for="nik" class="form-label">NIK</label>
            <input type="number" name="nik" value="{{ old('nik', $user->nik) }}" class="form-control" >
        </div>   --}}
        <div class="mb-3">
            <label for="nomor_hp" class="form-label">Nomor HP</label>
            <input type="number" name="nomor_hp" value="{{ old('nomor_hp', $user->nomor_hp) }}" class="form-control" required>
        </div> 

     <div class="mb-3">
            <label for="alamat_tanggallahir" class="form-label">Alamat & Tanggal Lahir</label>
            <input type="text" name="alamat_tanggallahir" value="{{ old('alamat_tanggallahir', $user->alamat_tanggallahir) }}" class="form-control" required>
        </div>  

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}" class="form-control" required>
        </div>

        

        <div class="mb-3">
            <label for="role" class="form-label">Role</label>
            <select name="role" id="role" class="form-select" required>
                <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="perangkatdesa" {{ old('role', $user->role) === 'perangkatdesa' ? 'selected' : '' }}>Perangkat Desa</option>
                <option value="warga" {{ old('role', $user->role) === 'warga' ? 'selected' : '' }}>Warga</option>
            </select>
        </div>

        <div class="mb-3" id="nik-field" style="display: none;">
            <label for="nik" class="form-label">NIK</label>
            <input type="number" name="nik" id="nik" value="{{ old('nik', $user->nik) }}" class="form-control">
        </div>

        <div class="mb-3" id="no_kk-field" style="display: none;">
            <label for="no_kk" class="form-label">NO KK</label>
            <input type="text" name="no_kk" id="no_kk" value="{{ old('no_kk', $user->no_kk) }}" class="form-control">
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password Baru <small class="text-muted">(abaikan jika tidak ingin mengganti)</small></label>
            <input type="password" name="password" class="form-control">
        </div>

        <script>
document.addEventListener('DOMContentLoaded', function() {
    const roleSelect = document.getElementById('role');
    const nikField = document.getElementById('nik-field');
    const noKkField = document.getElementById('no_kk-field');

    function toggleNikField() {
        nikField.style.display = (roleSelect.value === 'warga') ? 'block' : 'none';
        noKkField.style.display = (roleSelect.value === 'warga') ? 'block' : 'none';
    }

    roleSelect.addEventListener('change', toggleNikField);
    toggleNikField(); // initial state
});
</script>

        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
