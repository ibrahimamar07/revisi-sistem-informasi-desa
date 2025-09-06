
@extends('layouts.app')

@section('title', 'Tambah Perihal Surat')
@section('page-title', 'Tambah Perihal Surat')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold">
                    <i class="fas fa-plus me-2"></i>Form Tambah Perihal Surat
                </h6>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.perihal-surat.store') }}" method="POST">
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
                        <label for="deskripsi" class="form-label">Deskripsi Perihal *</label>
                        <textarea class="form-control @error('deskripsi') is-invalid @enderror" 
                                  id="deskripsi" name="deskripsi" rows="4" required>{{ old('deskripsi') }}</textarea>
                        @error('deskripsi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.perihal-surat.index') }}" class="btn btn-secondary">
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