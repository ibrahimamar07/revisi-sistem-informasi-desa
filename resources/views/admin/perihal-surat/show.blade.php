
@extends('layouts.app')

@section('title', 'Detail Perihal Surat')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Detail Perihal Surat</h2>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Deskripsi Perihal</h5>
            <p class="card-text">{{ $perihalSurat->deskripsi }}</p>
        </div>
    </div>

    <a href="{{ route('admin.perihal-surat.index') }}" class="btn btn-secondary mt-3">Kembali</a>
</div>
@endsection
