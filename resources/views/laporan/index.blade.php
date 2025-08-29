@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h3>Laporan Surat</h3>
    <form action="{{ route('laporan.cetak') }}" method="POST">
        
        @csrf
        <div class="mb-3">
            <label>Pilih Jenis Surat</label><br>
            <input type="radio" name="jenis_surat" value="masuk" checked> Surat Masuk
            <input type="radio" name="jenis_surat" value="keluar"> Surat Keluar
        </div>
        <div class="mb-3">
            <label>Masukan Nomor</label>
            <input type="text" name="nomor" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Masukan Tanggal</label>
            <input type="date" name="tanggal" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Cetak</button>
      
    </form>
</div>
@endsection
