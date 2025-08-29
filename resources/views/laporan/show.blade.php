@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h3>Detail Laporan Surat {{ ucfirst($jenis) }}</h3>

    @if($data)
        <table class="table">
            <tr><th>Nomor Surat</th><td>{{ $data->no_surat }}</td></tr>
            <tr><th>Tanggal</th><td>{{ $data->tanggal->format('d/m/Y')}}</td></tr>
            <tr><th>Perihal</th><td>{{ $data->perihalsurat->deskripsi ?? 'Perihal tidak tersedia' }}</td></tr>
            <tr>
                <th>File</th>
                <td>
                    <a href="{{ asset('storage/' . $data->path) }}" target="_blank" class="btn btn-sm btn-primary">Download File</a>
                    <br><br>

            @php
                $filePath = 'storage/' . $data->path;
                $extension = pathinfo($filePath, PATHINFO_EXTENSION);
            @endphp

            @if(in_array($extension, ['pdf']))
                <iframe src="{{ asset($filePath) }}" width="100%" height="600px"></iframe>
            @elseif(in_array($extension, ['doc', 'docx']))
                <p class="text-yellow-600">File Word tidak bisa dipreview. Silakan unduh file:</p>
            @else
                <p class="text-red-600">Format file tidak didukung untuk preview. silahkan unduh file</p>
            @endif
                </td>
            </tr>
        </table>
    @else
        <div class="alert alert-danger">Data surat tidak ditemukan.</div>
    @endif
</div>
@endsection
