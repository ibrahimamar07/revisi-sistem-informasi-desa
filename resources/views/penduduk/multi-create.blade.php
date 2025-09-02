@extends('layoutspenduduk.app')

@section('title', 'Tambah Penduduk Multi - Sistem Informasi Desa')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/multi-penduduk.css') }}">
@endsection

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2"><i class="fas fa-users me-2"></i>Tambah Penduduk</h1>
</div>

@if ($errors->any())
    <div class="alert alert-danger">
        <h4><i class="fas fa-exclamation-triangle"></i> Terdapat kesalahan pada form:</h4>
        <div class="row">
            <div class="col-md-6">
                <h6>Error per Baris:</h6>
                <ul class="mb-0">
                    @php
                        $rowErrors = [];
                        foreach ($errors->keys() as $key) {
                            if (strpos($key, 'row_') === 0) {
                                $rowErrors[] = $errors->first($key);
                            }
                        }
                    @endphp
                    
                    @if (count($rowErrors) > 0)
                        @foreach ($rowErrors as $error)
                            <li class="text-danger">{{ $error }}</li>
                        @endforeach
                    @else
                        @foreach ($errors->all() as $error)
                            <li class="text-danger">{{ $error }}</li>
                        @endforeach
                    @endif
                </ul>
            </div>
            @if ($errors->has('database_error'))
                <div class="col-md-6">
                    <h6>Error Database:</h6>
                    <p class="text-danger mb-0">{{ $errors->first('database_error') }}</p>
                </div>
            @endif
        </div>
    </div>
@endif

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="card">
    <div class="card-body">
    <div class="btn-group">
        <a href="{{ route('penduduk.export') }}" class="btn btn-success">
            <i class="fas fa-file-excel me-2"></i>Ekspor Data
        </a>
        <a href="{{ route('penduduk.show-import') }}" class="btn btn-info text-white">
            <i class="fas fa-file-import me-2"></i>Impor Data
        </a>
    </div>
</div>

        <form method="POST" action="{{ route('penduduk.store') }}" id="multi-penduduk-form">
            @csrf
            <table class="table table-bordered" id="penduduk-table">
                <thead>
                    <tr>
                        <th>NIK</th>
                        <th>Nama</th>
                        <th>Jenis Kelamin</th>
                        <th>Agama</th>
                        <th>Alamat & Tanggal Lahir</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $oldPendudukData = session('old_penduduk_data', old('penduduk', [['nik' => '', 'nama' => '', 'jenis_kelamin' => '', 'agama' => '', 'alamat_tanggallahir' => '']]));
                        $rowCount = max(1, count($oldPendudukData));
                    @endphp
                    
                    @for ($i = 0; $i < $rowCount; $i++)
                        @php
                            $rowData = $oldPendudukData[$i] ?? ['nik' => '', 'nama' => '', 'jenis_kelamin' => '', 'agama' => '', 'alamat_tanggallahir' => ''];
                        @endphp
                        <tr data-index="{{ $i }}" @if($errors->hasAny(["row_{$i}_nik", "row_{$i}_nama", "row_{$i}_jk", "row_{$i}_agama", "row_{$i}_alamat"])) class="table-danger" @endif>
                            <td>
                                <input type="text" 
                                       name="penduduk[{{ $i }}][nik]" 
                                       class="form-control @if($errors->has("row_{$i}_nik")) is-invalid @endif" 
                                       maxlength="16" 
                                       placeholder="Masukkan 16 digit NIK"
                                       value="{{ $rowData['nik'] }}"
                                       required>
                                @if($errors->has("row_{$i}_nik"))
                                    <div class="invalid-feedback">{{ $errors->first("row_{$i}_nik") }}</div>
                                @endif
                            </td>
                            <td>
                                <input type="text" 
                                       name="penduduk[{{ $i }}][nama]" 
                                       class="form-control @if($errors->has("row_{$i}_nama")) is-invalid @endif" 
                                       placeholder="Nama lengkap"
                                       value="{{ $rowData['nama'] }}"
                                       required>
                                @if($errors->has("row_{$i}_nama"))
                                    <div class="invalid-feedback">{{ $errors->first("row_{$i}_nama") }}</div>
                                @endif
                            </td>
                            <td>
                                <select name="penduduk[{{ $i }}][jenis_kelamin]" class="form-select @if($errors->has("row_{$i}_jk")) is-invalid @endif" required>
                                    <option value="">Pilih</option>
                                    <option value="L" {{ $rowData['jenis_kelamin'] == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="P" {{ $rowData['jenis_kelamin'] == 'P' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                                @if($errors->has("row_{$i}_jk"))
                                    <div class="invalid-feedback">{{ $errors->first("row_{$i}_jk") }}</div>
                                @endif
                            </td>
                            <td>
                                <select name="penduduk[{{ $i }}][agama]" class="form-select @if($errors->has("row_{$i}_agama")) is-invalid @endif" required>
                                    <option value="">Pilih</option>
                                    <option value="Islam" {{ $rowData['agama'] == 'Islam' ? 'selected' : '' }}>Islam</option>
                                    <option value="Kristen" {{ $rowData['agama'] == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                                    <option value="Katolik" {{ $rowData['agama'] == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                                    <option value="Hindu" {{ $rowData['agama'] == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                    <option value="Buddha" {{ $rowData['agama'] == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                                    <option value="Konghucu" {{ $rowData['agama'] == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                                </select>
                                @if($errors->has("row_{$i}_agama"))
                                    <div class="invalid-feedback">{{ $errors->first("row_{$i}_agama") }}</div>
                                @endif
                            </td>
                            <td>
                                <textarea name="penduduk[{{ $i }}][alamat_tanggallahir]" 
                                          class="form-control @if($errors->has("row_{$i}_alamat")) is-invalid @endif" 
                                          rows="2" 
                                          placeholder="Alamat lengkap, Tanggal lahir: DD/MM/YYYY"
                                          required>{{ $rowData['alamat_tanggallahir'] }}</textarea>
                                @if($errors->has("row_{$i}_alamat"))
                                    <div class="invalid-feedback">{{ $errors->first("row_{$i}_alamat") }}</div>
                                @endif
                            </td>
                            <td>
                                <button type="button" class="btn btn-danger btn-sm remove-row">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @endfor
                </tbody>
            </table>

            <div class="d-flex justify-content-between">
                <button type="button" id="add-row" class="btn btn-success">
                    <i class="fas fa-plus"></i> Tambah Baris
                </button>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Simpan Semua
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('js/multi-penduduk.js') }}"></script>

<script>
window.initialRowCount = {{ $rowCount }};
@if(session('old_penduduk_data'))
window.oldPendudukData = @json(session('old_penduduk_data'));
@elseif(old('penduduk'))
window.oldPendudukData = @json(old('penduduk'));
@endif
console.log('Initial row count:', window.initialRowCount);
if (window.oldPendudukData) {
    console.log('Old data available:', window.oldPendudukData);
}
</script>
@endsection