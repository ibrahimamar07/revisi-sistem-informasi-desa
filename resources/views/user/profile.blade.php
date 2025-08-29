@extends('layoutspenduduk.app')

@section('title', 'Profil Akun - Sistem Informasi Desa')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2"><i class="fas fa-user me-2"></i>Akun</h1>
</div>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fas fa-user-cog me-2"></i>Informasi Akun
                </h5>
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <h6><i class="fas fa-exclamation-triangle me-2"></i>Terdapat kesalahan:</h6>
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('user.profile.update') }}">
                    @csrf
                    @method('PUT')
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="nama" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" 
                                   id="nama" name="nama" value="{{ old('nama', $user->nama) }}" 
                                   placeholder="Nama lengkap" required>
                            @error('nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                   id="email" name="email" value="{{ old('email', $user->email) }}" 
                                   placeholder="Email" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="nomor_hp" class="form-label">Nomor HP <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('nomor_hp') is-invalid @enderror" 
                                   id="nomor_hp" name="nomor_hp" value="{{ old('nomor_hp', $user->nomor_hp) }}" 
                                   placeholder="08xxxxxxxxxx" required>
                            @error('nomor_hp')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="role" class="form-label">Role</label>
                            <input type="text" class="form-control" value="{{ ucfirst($user->role) }}" readonly>
                            <small class="text-muted">Role tidak dapat diubah</small>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="alamat_tanggallahir" class="form-label">Alamat & Tanggal Lahir <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('alamat_tanggallahir') is-invalid @enderror" 
                                  id="alamat_tanggallahir" name="alamat_tanggallahir" rows="3" 
                                  placeholder="Alamat lengkap dan tanggal lahir" required>{{ old('alamat_tanggallahir', $user->alamat_tanggallahir) }}</textarea>
                        @error('alamat_tanggallahir')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <hr>

                    <h6 class="text-muted mb-3">Ubah Password (Opsional)</h6>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="password" class="form-label">Password Baru</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                   id="password" name="password" placeholder="Kosongkan jika tidak ingin mengubah">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Minimal 8 karakter</small>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="password_confirmation" class="form-label">Konfirmasi Password Baru</label>
                            <input type="password" class="form-control" 
                                   id="password_confirmation" name="password_confirmation" 
                                   placeholder="Konfirmasi password baru">
                        </div>
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Update Profil
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fas fa-info-circle me-2"></i>Informasi Akun
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <small class="text-muted">Akun Dibuat:</small>
                        <div class="fw-bold">{{ $user->created_at->format('d F Y, H:i') }} WIB</div>
                    </div>
                    <div class="col-md-6">
                        <small class="text-muted">Terakhir Diupdate:</small>
                        <div class="fw-bold">{{ $user->updated_at->format('d F Y, H:i') }} WIB</div>
                    </div>
                </div>
                
                <hr>
                <div class="row">
                    <div class="col-md-6">
                        <small class="text-muted">Status Akun:</small>
                        <div>
                            <span class="badge bg-success">
                                <i class="fas fa-check me-1"></i>Aktif
                            </span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <small class="text-muted">Hak Akses:</small>
                        <div>
                            @if($user->isAdmin())
                                <span class="badge bg-primary">
                                    <i class="fas fa-crown me-1"></i>Administrator
                                </span>
                            @else
                                <span class="badge bg-secondary">
                                    <i class="fas fa-user me-1"></i>Non-Admin
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection