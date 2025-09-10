 <!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Surat Keterangan Tidak Mampu</title>
    <style>
        body { font-size: 14px; }
        .surat { padding: 40px; }
        .kop-surat { text-align: center; border-bottom: 2px solid black; margin-bottom: 20px; }
        .judul-surat { text-align: center; font-weight: bold; text-decoration: underline; margin: 20px 0; }
        .isi-surat { margin-top: 20px; line-height: 1.6; }
        .ttd { margin-top: 40px; text-align: right; }
        .cap-ttd { margin-top: 80px; font-weight: bold; }
        .kop-surat img {
        width: 80px;
        position: absolute;
        left: 50px;
        top: 60px;
    }
    </style>
</head>
<body>
<div class="surat">
   
    <div class="kop-surat">
        <img src="{{ public_path('img/Logo_kab_Purworejo.png') }}" alt="Logo">
        <h3>PEMERINTAH KABUPATEN PURWOREJO</h3>
        <h4>KECAMATAN PITURUH</h4>
        <h5>DESA GUMAWANGREJO</h5>
        <p><strong>Desa Gumawangrejo Rt 02/Rw 01 Kode Pos 54263</strong></p>
    </div>

   
    <div class="judul-surat">
        SURAT KETERANGAN TIDAK MAMPU <br>
        <span>No: 010/SKTMS/{{ date('Y') }}</span>
    </div>

   
    <div class="isi-surat">
        <p>Yang bertanda tangan di bawah ini Kepala Desa Gumawangrejo, Kecamatan Pituruh, Kabupaten Purworejo
            menerangkan dengan sesungguhnya bahwa:</p>
        <table style="width:100%">
            <tr><td style="width:180px">Nama</td><td>: {{ $nama }}</td></tr>
            <tr><td>NIK</td><td>: {{ $nik }}</td></tr>
            <tr><td>Tempat/Tgl Lahir</td><td>: {{ $ttl }}</td></tr>
            <tr><td>Jenis Kelamin</td><td>: {{ $jk }}</td></tr>
            <tr><td>Pekerjaan</td><td>: {{ $pekerjaan }}</td></tr>
            <tr><td>Agama</td><td>: {{ $agama }}</td></tr>
            <tr><td>Alamat</td><td>: {{ $alamat }}</td></tr>
        </table>
        <p>
            Nama tersebut di atas benar warga Desa Gumawangrejo, Kecamatan Pituruh, Kabupaten Purworejo.
            Berdasarkan keterangan yang ada pada kami benar bahwa yang bersangkutan tergolong keluarga yang tidak
            mampu. Surat keterangan ini dibuat untuk keperluan yang bersangkutan.
        </p>
        <p>Demikian surat keterangan ini dibuat, atas perhatian dan kerjasamanya kami ucapkan terima kasih.</p>
    </div>

   
    <div class="ttd">
        <p>Gumawangrejo, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
        <p><strong>KEPALA DESA GUMAWANGREJO</strong></p>
        <div class="cap-ttd">SUKIMAN</div>
    </div>
</div>
</body>
</html> 


