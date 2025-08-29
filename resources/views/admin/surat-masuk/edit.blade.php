@extends('layouts.app')

@section('title', 'Edit Surat Masuk')

@section('content')
<div class="container">
    <h4 class="mb-4">Edit Surat Masuk</h4>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.surat-masuk.update', $suratMasuk->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="no_surat" class="form-label">No. Surat</label>
            <input type="text" name="no_surat" class="form-control" value="{{ old('no_surat', $suratMasuk->no_surat) }}" required>
        </div>

        <div class="mb-3">
            <label for="tanggal" class="form-label">Tanggal</label>
            <input type="date" name="tanggal" class="form-control" value="{{ old('tanggal', $suratMasuk->tanggal) }}" required>
        </div>

        <div class="mb-3">
            <label for="perihal_surat_id" class="form-label">Perihal</label>
            <select name="perihal_surat_id" class="form-select" required>
                <option value="">-- Pilih Perihal --</option>
                @foreach($perihalSurat as $perihal)
                    <option value="{{ $perihal->id }}" {{ old('perihal_surat_id', $suratMasuk->perihal_surat_id) == $perihal->id ? 'selected' : '' }}>
                        {{ $perihal->deskripsi }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">File Surat (opsional)</label>
            <input type="file" name="file_surat" class="form-control">
            @if($suratMasuk->path)
                <small class="text-muted">File saat ini: <a href="{{ asset('storage/' . $suratMasuk->path) }}" target="_blank">Lihat File</a></small>
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        <a href="{{ route('admin.surat-masuk.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
