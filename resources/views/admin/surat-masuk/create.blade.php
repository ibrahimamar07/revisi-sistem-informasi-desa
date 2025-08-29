
@extends('layouts.app')

@section('title', 'Tambah Surat Masuk')
@section('page-title', 'Tambah Surat Masuk')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold">
                    <i class="fas fa-plus me-2"></i>Form Tambah Surat Masuk
                </h6>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.surat-masuk.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="mb-3">
                        <label for="no_surat" class="form-label">No. Surat *</label>
                        <input type="text" class="form-control @error('no_surat') is-invalid @enderror" 
                               id="no_surat" name="no_surat" value="{{ old('no_surat') }}" required>
                        @error('no_surat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="tanggal" class="form-label">Tanggal Surat *</label>
                        <input type="date" class="form-control @error('tanggal') is-invalid @enderror" 
                               id="tanggal" name="tanggal" value="{{ old('tanggal') }}" required>
                        @error('tanggal')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="perihal_surat_id" class="form-label">Perihal Surat *</label>
                        <select class="form-select @error('perihal_surat_id') is-invalid @enderror" 
                                id="perihal_surat_id" name="perihal_surat_id" required>
                            <option value="">Pilih Perihal Surat</option>
                            @foreach($perihalSurat as $perihal)
                                <option value="{{ $perihal->id }}" 
                                        {{ old('perihal_surat_id') == $perihal->id ? 'selected' : '' }}>
                                    {{ $perihal->deskripsi }}
                                </option>
                            @endforeach
                        </select>
                        @error('perihal_surat_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="file_surat" class="form-label">File Surat *</label>
                        <input type="file" class="form-control @error('file_surat') is-invalid @enderror" 
                               id="file_surat" name="file_surat" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png" required>
                        <div class="form-text">
                            Format yang diizinkan: PDF, DOC, DOCX, JPG, JPEG, PNG. Maksimal 5MB.
                        </div>
                        @error('file_surat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.surat-masuk.index') }}" class="btn btn-secondary">
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