@extends('layoutspenduduk.app')

@section('title', 'Impor Data Penduduk - Sistem Informasi Desa')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2"><i class="fas fa-file-import me-2"></i>Impor Data Penduduk</h1>
</div>

@if (session('import_errors'))
    <div class="alert alert-danger">
        <h4><i class="fas fa-exclamation-triangle"></i> Terjadi kesalahan saat impor:</h4>
        <ul class="mb-0">
            @foreach (session('import_errors') as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="card">
    <div class="card-body">
        <div class="alert alert-info" role="alert">
            <h5 class="alert-heading"><i class="fas fa-info-circle me-2"></i><strong>Penting: Baca Panduan Sebelum Impor!</strong></h5>
            <p class="mb-0">
                Untuk menghindari kesalahan, mohon baca panduan lengkap cara mengisi template dan mengimpor data.
                <a href="{{ route('penduduk.guideimpor') }}" class="alert-link">Klik di sini untuk membaca panduan.</a>
            </p>
        </div>

        <form action="{{ route('penduduk.import') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="file" class="form-label">Pilih File Excel (.xlsx, .xls)</label>
                <input type="file" name="file" id="file" class="form-control @error('file') is-invalid @enderror" required>
                @error('file')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-upload me-2"></i>Mulai Impor
            </button>
            <a href="{{ route('penduduk.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-2"></i>Kembali
            </a>
        </form>
        <hr>
        <p class="mt-3">
            Untuk mengunduh template impor, silakan <a href="{{ route('penduduk.template') }}">klik di sini</a>.
        </p>
        {{-- <p class="mt-3">
            Untuk melihat panduan cara mengimpor <a href="{{ route('penduduk.guideimpor') }}">klik di sini</a>.
        </p> --}}
    </div>
</div>
@endsection