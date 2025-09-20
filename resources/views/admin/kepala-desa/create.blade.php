
@extends('layouts.app')

@section('title', 'Tambah Kepala Desa')
@section('page-title', 'Tambah Kepala Desa')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold">
                    <i class="fas fa-plus me-2"></i>Form Tambah Kepala Desa
                </h6>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.kepala-desa.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-3">
                        <label for="nama_kades" class="form-label">Nama Kepala Desa*</label>
                        <input type="text" class="form-control @error('nama_kades') is-invalid @enderror" 
                               id="nama_kades" name="nama_kades" value="{{ old('nama_kades') }}" required>
                        @error('no_surat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.kepala-desa.index') }}" class="btn btn-secondary">
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
@endsection