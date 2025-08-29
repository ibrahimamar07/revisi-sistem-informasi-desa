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

    <form action="{{ route('admin.perihal-surat.update', $perihalSurat->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi Perihal Surat</label>
            <input type="text" name="deskripsi" class="form-control" value="{{ old('deskripsi', $perihalSurat->deskripsi) }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('admin.perihal-surat.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
