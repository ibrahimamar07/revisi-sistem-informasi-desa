@extends('layouts.app')

@section('content')
<div class="container">
    <h4 class="mb-4">Cetak Surat</h4>

    <form action="{{ route('laporan.cetak') }}" method="POST" class="row g-3">
        @csrf

        <div class="col-md-6">
            <label class="form-label">Nama</label>
            <input type="text" name="nama" class="form-control" required pattern="[A-Za-z\s]+" title="nama hanya boleh diisi dengan huruf">
        </div>

        <div class="col-md-6">
            <label class="form-label">NIK</label>
            <input type="number" name="nik" class="form-control"placeholder="masukkan NIK" required>
        </div>

        <div class="col-md-6">
            <label class="form-label">Tempat/Tgl Lahir</label>
            <input type="text" name="ttl" class="form-control" placeholder="contoh: Purworejo, 2003-02-02" required>
        </div>

        <div class="col-md-6">
            <label class="form-label">Jenis Kelamin</label>
            <select name="jk" class="form-select" required>
                <option value="" disabled selected>-- Pilih --</option>
                <option value="Laki-laki">Laki-laki</option>
                <option value="Perempuan">Perempuan</option>
            </select>
        </div>

        <div class="col-md-6">
            <label class="form-label">Pekerjaan</label>
            <input type="text" name="pekerjaan" class="form-control" required pattern="[A-Za-z\s]+" title="pekerjaan hanya boleh diisi dengan huruf">
        </div>

        <div class="col-md-6">
            <label class="form-label">Agama</label>
            <input type="text" name="agama" class="form-control" required pattern="[A-Za-z\s]+" title="agama hanya boleh diisi dengan huruf">
        </div>

        <div class="col-12">
            <label class="form-label">Alamat</label>
            <textarea name="alamat" class="form-control" rows="2" required></textarea>
        </div>

        <div class="col-12">
            <button type="submit" class="btn btn-primary w-100">Download Surat</button>
        </div>
    </form>
</div>
@endsection
