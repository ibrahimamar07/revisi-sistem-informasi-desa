@extends('layoutspenduduk.app')

@section('title', 'Login - Sistem Informasi Desa')

@section('content')
<div class="d-flex align-items-center justify-content-center min-vh-100 bg-light">
    <div class="card shadow-sm" style="width: 100%; max-width: 400px;">
        <div class="card-body p-4">
            <div class="text-center mb-4">
                <i class="fas fa-city text-primary mb-3" style="font-size: 3rem;"></i>
                <h4 class="card-title">Sistem Informasi Desa</h4>
                <p class="text-muted">Silakan login untuk melanjutkan</p>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('loginpenduduk') }}">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fas fa-envelope"></i>
                        </span>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" 
                               id="email" name="email" value="{{ old('email') }}" required 
                               placeholder="Masukkan email Anda">
                    </div>
                    @error('email')
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
                               id="nik" name="nik" value="{{ old('nik') }}"
                               placeholder="Masukkan NIK Anda">
                    </div>
                    @error('nik')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password" class="form-label">Password</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fas fa-lock"></i>
                        </span>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" 
                               id="password" name="password" required 
                               placeholder="Masukkan password Anda">
                    </div>
                    @error('password')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-sign-in-alt me-2"></i>Login
                    </button>
                </div>
            </form>
            <a href="{{ route('portal.portal') }}" class="btn btn-outline-secondary w-100 mt-2">
                            <i class="fas fa-arrow-left me-2"></i> Kembali ke Portal
                        </a>
            <div class="text-center mt-3">
                <p class="mb-0">Belum punya akun? 
                    <a href="{{ route('register') }}" class="text-decoration-none">Daftar di sini</a>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection