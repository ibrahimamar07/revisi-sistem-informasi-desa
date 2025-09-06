
@extends('layouts.app')

@section('title', 'Detail Surat Keluar')
@section('page-title', 'Detail Surat Keluar')

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold">
                    <i class="fas fa-file-alt me-2"></i>Informasi Surat Keluar
                </h6>
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <th width="30%">No. Surat</th>
                        <td>: {{ $suratKeluar->perihalSurat?->no_surat?? 'no surat belum ada' }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal</th>
                        <td>: {{ $suratKeluar->tanggal->format('d F Y') }}</td>
                    </tr>
                     <tr>
                        <th>Pengirim</th>
                        <td>: {{ $suratKeluar->pengirim}}</td>
                    </tr>
                    <tr>
                        <th>Perihal</th>
                        <td>{{ Str::limit($suratKeluar->perihalSurat?->deskripsi ?? 'Perihal tidak tersedia', 50) }}</td>
                    </tr>
                    {{-- <tr>
                        <th>File Surat</th>
                        <td>: 
                            @if($suratKeluar->path)
                                <a href="{{ route('tenaga-pendidik.surat-keluar.download', $suratKeluar) }}" 
                                   class="btn btn-sm btn-primary">
                                    <i class="fas fa-download me-1"></i>Download File
                                </a>
                                <div class="mt-2">
                                    <small class="text-muted">
                                        Nama File: {{ $suratKeluar->file_name }}<br>
                                        Ukuran: {{ $suratKeluar->formatted_file_size }}
                                    </small>
                                </div>
                            @else
                                <span class="text-muted">Tidak ada file</span>
                            @endif
                        </td>
                    </tr> --}}
                    <tr>
                        <th>Dibuat Oleh</th>
                        <td>{{ $suratKeluar->creator?->name?? 'pembuat tidak tersedia' }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal Dibuat</th>
                        <td>: {{ $suratKeluar->created_at->format('d F Y H:i') }}</td>
                    </tr>
                </table>

                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('tenaga-pendidik.surat-keluar.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-2"></i>Kembali
                    </a>
                    <div>
                        <a href="{{ route('tenaga-pendidik.surat-keluar.edit', $suratKeluar) }}" class="btn btn-warning">
                            <i class="fas fa-edit me-2"></i>Edit
                        </a>
                        <form action="{{ route('tenaga-pendidik.surat-keluar.destroy', $suratKeluar) }}" 
                              method="POST" class="d-inline ms-2">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" 
                                    onclick="return confirm('Yakin ingin menghapus?')">
                                <i class="fas fa-trash me-2"></i>Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <div class="col-md-4">
        @if($suratKeluar->path)
            <div class="card">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold">
                        <i class="fas fa-eye me-2"></i>Preview File
                    </h6>
                </div>
                <div class="card-body text-center">
                    @php
                        $extension = pathinfo($suratKeluar->path, PATHINFO_EXTENSION);
                    @endphp
                    
                    @if(in_array(strtolower($extension), ['jpg', 'jpeg', 'png']))
                        <img src="{{ asset('storage/' . $suratKeluar->path) }}" 
                             class="img-fluid rounded" alt="Preview">
                    @elseif(strtolower($extension) === 'pdf')
                        <div class="text-center p-4">
                            <i class="fas fa-file-pdf fa-5x text-danger mb-3"></i>
                            <p>File PDF</p>
                            <a href="{{ asset('storage/' . $suratKeluar->path) }}" 
                               target="_blank" class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-external-link-alt me-1"></i>Buka di Tab Baru
                            </a>
                        </div>
                    @else
                        <div class="text-center p-4">
                            <i class="fas fa-file fa-5x text-secondary mb-3"></i>
                            <p>{{ strtoupper($extension) }} File</p>
                        </div>
                    @endif
                </div>
            </div>
        @endif
    </div> --}}
</div>
@endsection