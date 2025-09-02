<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panduan Impor Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            max-width: 900px;
            margin-top: 50px;
            margin-bottom: 50px;
        }
        .card-header {
            background-color: #0d6efd;
            color: white;
            font-weight: bold;
        }
        .step-title {
            color: #0d6efd;
            font-weight: bold;
        }
        .alert-info, .alert-warning, .alert-danger {
            margin-top: 15px;
        }
        .accordion-item {
            border: 1px solid #dee2e6;
        }
        .error-list {
            padding-left: 20px;
        }
        .error-card-title {
            background-color: #dc3545;
            color: white;
            padding: 10px;
            margin-bottom: 0;
            border-radius: .375rem .375rem 0 0;
            font-weight: bold;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="card shadow-sm">
        <div class="card-header text-center py-3">
            Panduan Impor Data Penduduk via Excel
        </div>
        <div class="card-body p-4">

            @if(session('import_errors'))
                <div class="alert alert-danger" role="alert">
                    <h4 class="alert-heading">Gagal Impor! Ada Kesalahan Data.</h4>
                    <p>Proses impor dibatalkan karena data yang Anda unggah tidak valid. Mohon perbaiki data pada baris dan kolom yang ditunjukkan di bawah ini, lalu coba impor kembali.</p>
                    <hr>
                    <ul class="error-list">
                        @foreach(session('import_errors') as $error)
                            <li>&#x274C; {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="accordion" id="importGuideAccordion">
                
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            Langkah 1: Unduh dan Persiapkan Template Excel
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#importGuideAccordion">
                        <div class="accordion-body">
                            <p>Untuk menghindari kesalahan, sangat disarankan untuk menggunakan template Excel yang sudah disediakan. Template ini memiliki format kolom yang sesuai dengan kebutuhan sistem.</p>
                            <p><strong> JANGAN MERUBAH POSISI KOLOM DAN NAMA KOLOM PADA TEMPLATE</strong></p>
                            <p>
                                <a href="{{ route('penduduk.template') }}" class="btn btn-primary">Unduh Template Excel</a>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            Langkah 2: Isi Data dengan Benar
                        </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#importGuideAccordion">
                        <div class="accordion-body">
                            <p>Pastikan Anda mengisi data sesuai dengan format yang telah ditentukan.</p>
                            <ul>
                                <li><strong>NIK:</strong> Harus berisi **tepat 16 digit angka**. Jangan ada spasi, tanda baca, atau huruf. Sistem tidak akan menerima NIK yang tidak valid.</li>
                                <li><strong>Nama:</strong> Wajib diisi dan tidak boleh lebih dari 255 karakter.</li>
                                <li><strong>Jenis Kelamin:</strong> Harus diisi dengan **"L"** untuk Laki-laki atau **"P"** untuk Perempuan atau bisa menggunakan huruf kecil `l` atau `p`.</li>
                                <li><strong>Agama:</strong> Wajib diisi.</li>
                                <li><strong>Alamat Tanggal Lahir:</strong> Wajib diisi.</li>
                            </ul>
                            <div class="alert alert-warning" role="alert">
                                <strong>Peringatan Penting:</strong>
                                <p>Sistem akan menolak seluruh proses impor jika menemukan satu saja kesalahan format data, termasuk NIK yang sudah ada di database atau NIK yang tidak valid.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingThree">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            Langkah 3: Unggah File Excel
                        </button>
                    </h2>
                    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#importGuideAccordion">
                        <div class="accordion-body">
                            <p>Setelah selesai mengisi template, unggah file Anda. Pastikan file berformat **.xls** atau **.xlsx** dan ukuran file tidak melebihi **10 MB**.</p>
                            <p>Sistem akan memproses data Anda dalam **satu transaksi**. Ini berarti, jika ada satu kesalahan validasi, seluruh data tidak akan diimpor untuk menjaga integritas database.</p>
                            <div class="alert alert-info" role="alert">
                                <strong>Tips:</strong>
                                <p>Jika impor gagal, periksa kembali pesan kesalahan yang muncul. Pesan tersebut akan memberi tahu baris dan kolom mana yang bermasalah.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingFour">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                            Penjelasan Kesalahan Impor (Troubleshooting)
                        </button>
                    </h2>
                    <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#importGuideAccordion">
                        <div class="accordion-body">
                            <p>Berikut adalah beberapa pesan kesalahan umum yang mungkin Anda temui dan cara memperbaikinya.</p>

                            <h5 class="step-title mt-4">NIK</h5>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <strong><span class="text-danger">Pesan Error:</span> `The nik field must be 16 characters.`</strong>
                                    <p class="mb-1"><strong>Penjelasan:</strong> Panjang NIK tidak sesuai. Mungkin NIK Anda kurang atau lebih dari 16 digit. Excel kadang merubah NIK menjadi format numerik sehingga digit awal '0' hilang.</p>
                                    <p class="mb-0"><strong>Solusi:</strong> Di sarankan  kolom NIK di Excel diformat sebagai **Teks (Text)** sebelum Anda memasukkan data. Perbaiki NIK agar tepat 16 digit.</p>
                                </li>
                                <li class="list-group-item">
                                    <strong><span class="text-danger">Pesan Error:</span> `The nik has already been taken.`</strong>
                                    <p class="mb-1"><strong>Penjelasan:</strong> NIK yang Anda coba impor sudah ada di database. Setiap NIK harus unik.</p>
                                    <p class="mb-0"><strong>Solusi:</strong> Periksa kembali NIK yang duplikat, lalu hapus atau perbarui data yang ada di file.</p>
                                </li>
                                <li class="list-group-item">
                                    <strong><span class="text-danger">Pesan Error:</span> `The nik field is not a valid number.` atau `The nik format is invalid.`</strong>
                                    <p class="mb-1"><strong>Penjelasan:</strong> NIK mengandung huruf, spasi, atau karakter selain angka. Validasi ketat diterapkan untuk memastikan NIK hanya berisi digit.</p>
                                    <p class="mb-0"><strong>Solusi:</strong> Perbaiki NIK pada baris yang ditunjukkan agar hanya berisi angka.</p>
                                </li>
                            </ul>

                            <h5 class="step-title mt-4">Kolom Lainnya</h5>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <strong><span class="text-danger">Pesan Error:</span> `The nama field is required.` atau `The nama field must not be greater than 255 characters.`</strong>
                                    <p class="mb-1"><strong>Penjelasan:</strong> Kolom nama kosong atau terlalu panjang.</p>
                                    <p class="mb-0"><strong>Solusi:</strong> Isi nama pada baris yang kosong atau persingkat nama agar tidak lebih dari 255 karakter.</p>
                                </li>
                                <li class="list-group-item">
                                    <strong><span class="text-danger">Pesan Error:</span> `The jenis kelamin field is required.` atau `The selected jenis kelamin is invalid.`</strong>
                                    <p class="mb-1"><strong>Penjelasan:</strong> Kolom jenis kelamin kosong atau diisi selain 'L' atau 'P'.</p>
                                    <p class="mb-0"><strong>Solusi:</strong> Isi dengan `L` atau `P` sesuai jenis kelamin atau bisa menggunakan huruf kecil `l` atau `p`.</p>
                                </li>
                                <li class="list-group-item">
                                    <strong><span class="text-danger">Pesan Error:</span> `The agama field is required.`</strong>
                                    <p class="mb-1"><strong>Penjelasan:</strong> Kolom agama kosong.</p>
                                    <p class="mb-0"><strong>Solusi:</strong> Isi kolom agama pada baris yang ditunjukkan.</p>
                                </li>
                            </ul>

                        </div>
                    </div>
                </div>

            </div>
            
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>