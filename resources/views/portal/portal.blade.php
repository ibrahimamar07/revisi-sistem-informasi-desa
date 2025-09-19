<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Sistem Informasi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #e0f7fa, #ffffff);
            min-height: 100vh;
        }

        .card {
            border: none;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-6px);
            box-shadow: 0 12px 25px rgba(0, 0, 0, 0.1);
        }

        .icon-box {
            width: 80px;
            height: 80px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background-color: #f1f1f1;
            margin: 0 auto 20px auto;
        }

        .icon-box i {
            font-size: 36px;
            color: #007bff;
        }

        .btn-custom {
            padding: 10px 30px;
            font-weight: 600;
        }
    </style>
</head>
<body>

<div class="container py-5">
    <div class="text-center mb-5">
        <h1 class="fw-bold">Portal Sistem Informasi Desa Gumawangrejo</h1>
        <p class="lead text-muted">Silakan pilih layanan aplikasi yang ingin Anda akses:</p>
    </div>

    <div class="row justify-content-center g-4">
        <div class="col-md-5 col-lg-4">
            <div class="card p-4 text-center shadow-sm rounded-4 h-100">
                <div class="icon-box mb-3">
                    <i class="fas fa-users"></i>
                </div>
                <h4 class="fw-bold">Data Kependudukan</h4>
                <p class="text-muted">Akses dan kelola data penduduk secara digital dan terpusat.</p>
                <a href="{{route("dashboard") }}" class="btn btn-success btn-custom">
                    <i class="fas fa-sign-in-alt me-1"></i> Masuk Ke Web
                </a>
            </div>
        </div>
        
        <div class="col-md-5 col-lg-4">
            <div class="card p-4 text-center shadow-sm rounded-4 h-100">
                <div class="icon-box mb-3">
                    <i class="fas fa-envelope-open-text"></i>
                </div>
                <h4 class="fw-bold">Surat Menyurat</h4>
                <p class="text-muted">Kelola surat masuk, keluar, dan disposisi di lingkungan pemerintahan desa.</p>
                <a href="{{ url('web-a') }}" class="btn btn-primary btn-custom">
                    <i class="fas fa-sign-in-alt me-1"></i> Masuk Ke Web
                </a>
            </div>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
