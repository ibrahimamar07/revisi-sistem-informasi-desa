<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Sistem Surat-Menyurat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background-color: #f0f2f5;
        }
        .card {
            border-radius: 12px;
        }
        .input-group-text {
            background-color: #e9ecef;
            border-right: 0;
            border-radius: 0.375rem 0 0 0.375rem;
        }
        .form-control:not(:placeholder-shown) + .input-group-text {
            border-color: #0d6efd;
        }
        .invalid-feedback {
            display: block;
        }
        .card-title {
            font-weight: 600;
        }
    </style>
</head>
<body>

<div class="d-flex align-items-center justify-content-center min-vh-100 bg-light">
    <div class="card shadow-lg" style="width: 100%; max-width: 400px;">
        <div class="card-body p-5">
            <div class="text-center mb-4">
                <i class="fas fa-user-plus text-success mb-3" style="font-size: 3rem;"></i>
                <h4 class="card-title">Daftar Akun Baru</h4>
                <p class="text-muted">Buat akun untuk mengakses sistem</p>
            </div>

            @if(isset($errors) && $errors->any())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('register.suratmenyurat') }}">
                 @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Nama Lengkap</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fas fa-user"></i>
                        </span>
                        <input type="text" class="form-control" 
                               id="name" name="name" required 
                               placeholder="Masukkan nama lengkap">
                    </div>
                </div>

                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fas fa-user-circle"></i>
                        </span>
                        <input type="text" class="form-control" 
                               id="username" name="username" required 
                               placeholder="Masukkan username">
                    </div>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fas fa-lock"></i>
                        </span>
                        <input type="password" class="form-control" 
                               id="password" name="password" required 
                               placeholder="Masukkan password">
                    </div>
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
                    <a href="{{ route('login') }}" class="text-decoration-none">Login di sini</a>
                </p>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>