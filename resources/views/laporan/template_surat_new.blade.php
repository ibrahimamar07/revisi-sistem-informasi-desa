<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>{{ $perihal ?? 'Surat Keterangan Tidak Mampu' }}</title>
    <style>
        body { 
            font-size: 14px; 
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .surat { 
            padding: 40px; 
        }
        .kop-surat { 
            text-align: center; 
            border-bottom: 2px solid black; 
            margin-bottom: 20px; 
            position: relative;
            padding-top: 20px;
        }
        .kop-surat img {
            width: 80px;
            position: absolute;
            left: 0px;
            top: 20px;
        }
        .judul-surat { 
            text-align: center; 
            font-weight: bold; 
            text-decoration: underline; 
            margin: 20px 0; 
            font-size: 16px;
        }
        .isi-surat { 
            margin-top: 20px; 
            line-height: 1.6; 
            text-align: justify;
        }
        .ttd { 
            margin-top: 40px; 
            text-align: right; 
        }
        .cap-ttd { 
            margin-top: 80px; 
            font-weight: bold; 
        }
        table.data-table {
            width: 100%;
            margin: 15px 0;
        }
        table.data-table td {
            padding: 3px 0;
            vertical-align: top;
        }
        .no-surat {
            font-size: 12px;
            margin-top: 5px;
        }
    </style>
</head>
<body>
<div class="surat">
    <div class="kop-surat">
        <img src="{{ public_path('img/Logo_kab_Purworejo.png') }}" alt="Logo">
        <h3 style="margin: 0;">PEMERINTAH KABUPATEN PURWOREJO</h3>
        <h4 style="margin: 5px 0;">KECAMATAN PITURUH</h4>
        <h5 style="margin: 5px 0;">DESA GUMAWANGREJO</h5>
        <p style="margin: 5px 0;"><strong>Desa Gumawangrejo Rt 02/Rw 01 Kode Pos 54263</strong></p>
    </div>

    <div class="judul-surat">
        {{ strtoupper($perihal ?? 'SURAT KETERANGAN TIDAK MAMPU') }}<br>
        <div class="no-surat">No: {{ $no_surat }}</div>
    </div>

    <div class="isi-surat">
        <p>Yang bertanda tangan di bawah ini Kepala Desa Gumawangrejo, Kecamatan Pituruh, Kabupaten Purworejo
            menerangkan dengan sesungguhnya bahwa:</p>
        
        <table class="data-table">
            <tr>
                <td style="width:180px">Nama</td>
                <td style="width:10px">:</td>
                <td>{{ $nama }}</td>
            </tr>
            <tr>
                <td>NIK</td>
                <td>:</td>
                <td>{{ $nik }}</td>
            </tr>
            <tr>
                <td>Tempat/Tgl Lahir</td>
                <td>:</td>
                <td>{{ $ttl }}</td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>:</td>
                <td>{{ $alamat }}</td>
            </tr>
        </table>
        
        <p>
            Nama tersebut di atas benar warga Desa Gumawangrejo, Kecamatan Pituruh, Kabupaten Purworejo.
            Berdasarkan keterangan yang ada pada kami benar bahwa yang bersangkutan tergolong keluarga yang tidak
            mampu. Surat keterangan ini dibuat untuk keperluan yang bersangkutan.
        </p>
        
        <p>Demikian surat keterangan ini dibuat, atas perhatian dan kerjasamanya kami ucapkan terima kasih.</p>
    </div>

    <div class="ttd">
        <p>Gumawangrejo, {{ \Carbon\Carbon::parse($tanggal_surat)->translatedFormat('d F Y') }}</p>
        <p><strong>KEPALA DESA GUMAWANGREJO</strong></p>
        <div class="cap-ttd">{{ strtoupper($kepala_desa) }}</div>
    </div>
</div>
</body>
</html>