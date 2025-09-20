{{-- resources/views/admin/users/show.blade.php --}}
@extends('layouts.app')

@section('title', 'Detail Akun Pengguna')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Detail Akun Pengguna</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $user->name }}</h5>
            <p class="card-text"><strong>ID:</strong> {{ $user->id }}</p>
            <p class="card-text"><strong>Nama:</strong> {{ $user->nama }}</p>
            <p class="card-text"><strong>Email:</strong> {{ $user->email }}</p>
            <p class="card-text"><strong>Nomor HP:</strong> {{ $user->nomor_hp }}</p>
            <p class="card-text"><strong>NO KK:</strong> {{ $user->no_kk }}</p>
            <p class="card-text"><strong>NIK:</strong> {{ $user->nik }}</p>
            {{-- <p class="card-text"><strong>Password:</strong> {{ $user->password }}</p> --}}
            <p class="card-text"><strong>Role:</strong> 
                @if($user->role === 'admin')
                    Admin
                @elseif($user->role === 'warga')
                   warga
                   @elseif($user->role === 'perangkatdesa')
                     perangkat desa
                @else
                    -
                @endif
            </p>
             <p class="card-text"><strong>Alamat & Tanggal Lahir:</strong> {{ $user->alamat_tanggallahir }}</p>
            <p class="card-text"><strong>Dibuat pada:</strong> {{ $user->created_at->format('d M Y H:i') }}</p>
            <p class="card-text"><strong>Terakhir diperbarui:</strong> {{ $user->updated_at->format('d M Y H:i') }}</p>

            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary mt-3">Kembali</a>
            <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-primary mt-3">Edit</a>
        </div>
    </div>
</div>
@endsection
