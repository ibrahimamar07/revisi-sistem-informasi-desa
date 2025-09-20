@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Perihal Surat</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Oops!</strong> Ada kesalahan saat input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.kepala-desa.update', $kepalaDesa->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="nama_kades" class="form-label">Nama Kepala Desa</label>
            <input type="text" name="nama_kades" class="form-control" value="{{ old('nama_kades', $kepalaDesa->nama_kades) }}" required>
        </div> 

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('admin.kepala-desa.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
