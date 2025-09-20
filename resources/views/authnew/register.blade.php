@extends('layoutspenduduk.app')

@section('title', 'Register - Sistem Informasi Desa')

@section('content')
<div class="d-flex align-items-center justify-content-center min-vh-100 bg-light">
    <div class="card shadow-sm" style="width: 100%; max-width: 400px;">
        <div class="card-body p-4">
            <div class="text-center mb-4">
                <i class="fas fa-user-plus text-success mb-3" style="font-size: 3rem;"></i>
                <h4 class="card-title">Daftar Akun Baru</h4>
                <p class="text-muted">Buat akun untuk mengakses sistem</p>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Nama Lengkap</label>
                    <div class="input-group">
                        </span>
                        <input type="text" class="form-control @error('nama') is-invalid @enderror" 
                               id="nama" name="nama" value="{{ old('nama') }}" required 
                               placeholder="Masukkan nama lengkap">
                    </div>
                    @error('nama')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fas fa-envelope"></i>
                        </span>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" 
                               id="email" name="email" value="{{ old('email') }}" required 
                               placeholder="Masukkan email">
                    </div>
                    @error('email')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="no_kk" class="form-label">NO KK</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="bi bi-person-vcard"></i>
                        </span>
                        <input type="text" class="form-control @error('no_kk') is-invalid @enderror" 
                               id="no_kk" name="no_kk" value="{{ old('no_kk') }}" required 
                               placeholder="Masukkan NO KK  Anda">
                    </div>
                    @error('no_kk')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="nik" class="form-label">nik</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fas fa-envelope"></i>
                        </span>
                        <input type="nik" class="form-control @error('nik') is-invalid @enderror" 
                               id="nik" name="nik" value="{{ old('nik') }}" required 
                               placeholder="Masukkan NIK Anda">
                    </div>
                    @error('nik')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="nomor_hp" class="form-label">Nomor HP</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fas fa-phone"></i>
                        </span>
                        <input type="text" class="form-control @error('nomor_hp') is-invalid @enderror" 
                               id="nomor_hp" name="nomor_hp" value="{{ old('nomor_hp') }}" required 
                               placeholder="08xxxxxxxxxx">
                    </div>
                    @error('nomor_hp')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="alamat_tanggallahir" class="form-label">Alamat & Tanggal Lahir</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fas fa-map-marker-alt"></i>
                        </span>
                        <textarea class="form-control @error('alamat_tanggallahir') is-invalid @enderror" 
                                  id="alamat_tanggallahir" name="alamat_tanggallahir" rows="2" required 
                                  placeholder="Alamat lengkap dan tanggal lahir">{{ old('alamat_tanggallahir') }}</textarea>
                    </div>
                    @error('alamat_tanggallahir')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fas fa-lock"></i>
                        </span>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" 
                               id="password" name="password" required 
                               placeholder="Masukkan password">
                    </div>
                    @error('password')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fas fa-lock"></i>
                        </span>
                        <input type="password" class="form-control" 
                               id="password_confirmation" name="password_confirmation" required 
                               placeholder="Konfirmasi password">
                    </div>
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-user-plus me-2"></i>Daftar
                    </button>
                </div>
            </form>

            <div class="text-center mt-3">
                <p class="mb-0">Sudah punya akun? 
                    <a href="{{ route('loginpenduduk') }}" class="text-decoration-none">Login di sini</a>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection