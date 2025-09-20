{{-- resources/views/admin/users/create.blade.php --}}
@extends('layouts.app')

@section('title', 'Tambah Pengguna')
@section('page-title', 'Tambah Pengguna')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold">
                    <i class="fas fa-plus me-2"></i>Form Tambah Pengguna
                </h6>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.users.store') }}" method="POST">
                    @csrf
                     
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama *</label>
                        <input type="text" class="form-control @error('nama') is-invalid @enderror" 
                               id="nama" name="nama" value="{{ old('nama') }}" required>
                        @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email *</label>
                       <input type="email" class="form-control" @error('email') is-invalid @enderror" 
                        id="email" name="email" value="{{ old('email') }}" required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                    </div>

                    <div class="mb-3">
                        <label for="nomor_hp" class="form-label">Nomor HP *</label>
                       <input type="number" class="form-control" @error('nomor_hp') is-invalid @enderror" 
                        id="nomor_hp" name="nomor_hp" value="{{ old('nomor_hp') }}" required>
                    @error('nomor_hp')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror   
                    </div>
                    <div class="mb-3">
                        <label for="alamat_tanggallahir" class="form-label">Alamat & Tanggal Lahir *</label>
                       <input type="text" class="form-control" @error('alamat_tanggallahir') is-invalid @enderror" 
                        id="alamat_tanggallahir" name="alamat_tanggallahir" value="{{ old('alamat_tanggallahir') }}" required>
                    @error('alamat_tanggallahir')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    </div>

                    <div class="mb-3">
                        <label for="role" class="form-label">Role *</label>
                        <select class="form-select @error('role') is-invalid @enderror" 
                                id="role" name="role" required>
                            <option value="">Pilih Role</option>
                            <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="perangkatdesa" {{ old('role') == 'perangkatdesa' ? 'selected' : '' }}>Perangkat Desa</option>
                            <option value="warga" {{ old('role') == 'warga' ? 'selected' : '' }}>Warga</option>
                        </select>
                        @error('role')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                     <div class="mb-3" id="nik-field" style="display: none;">
                        <label for="nik" class="form-label">NIK *</label>
                        <input type="number" class="form-control @error('nik') is-invalid @enderror" 
                               id="nik" name="nik" value="{{ old('nik') }}">
                        @error('nik')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3" id="no_kk-field" style="display: none;">
                        <label for="no_kk" class="form-label">NO KK </label>
                        <input type="number" class="form-control @error('no_kk') is-invalid @enderror" 
                               id="no_kk" name="no_kk" value="{{ old('no_kk') }}">
                        @error('no_kk')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password *</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" 
                               id="password" name="password" required>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Konfirmasi Password *</label>
                        <input type="password" class="form-control" 
                               id="password_confirmation" name="password_confirmation" required>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Kembali
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
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
@endsection