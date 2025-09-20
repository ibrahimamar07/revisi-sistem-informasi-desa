<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SuratKeluar;
use App\Models\PerihalSurat;
use App\Models\KepalaDesa;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;

class SuratKeluarController extends Controller
{
    public function index(Request $request)
{
    $query = SuratKeluar::with(['perihalSurat', 'creator'])->latest();

    if ($request->filled('q')) {
        $search = $request->q;
        $query->where(function ($q) use ($search) {
            $q->where('no_surat', 'like', "%$search%")
              ->orWhere('pengirim', 'like', "%$search%")
              ->orWhereDate('tanggal', $search)
              ->orWhereHas('perihalSurat', function ($q2) use ($search) {
                  $q2->where('deskripsi', 'like', "%$search%");
              });
        });
    }

    if ($request->filled('jumlah_waktu') && $request->filled('tipe_waktu')) {
    $jumlah = (int) $request->jumlah_waktu;
    switch ($request->tipe_waktu) {
        case 'hari':
            $query->where('tanggal', '>=', now()->subDays( $jumlah));
            break;
        case 'minggu':
            $query->where('tanggal', '>=', now()->subWeeks($jumlah));
            break;
        case 'bulan':
            $query->where('tanggal', '>=', now()->subMonths($jumlah));
            break;
        case 'tahun':
            $query->where('tanggal', '>=', now()->subYears($jumlah));
            break;
    }
}


    $suratKeluar = $query->paginate(15)->withQueryString();

    return view('admin.surat-keluar.index', compact('suratKeluar'));
}


    public function create()
    {
        $perihalSurat = PerihalSurat::all();
        $kepalaDesa = KepalaDesa::all();
        return view('admin.surat-keluar.create', compact('perihalSurat', 'kepalaDesa'));
    }

    public function store(Request $request)
    {
       
        $validated = $request->validate([
            // 'no_surat' => 'exists:perihal_surat,id',
            'tanggal' => 'required|date',
            'pengirim' => 'required|string|max:255',
            'nama_kades' => 'required|exists:kepaladesa,id',
            'perihal_surat_id' => 'required|exists:perihal_surat,id',
            // 'file_surat' => 'required|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:5120', // 5MB max
        ]);

        
        
         // Find the PerihalSurat model using the ID from the request
        $perihalSurat = PerihalSurat::find($request->perihal_surat_id);

        // Add the no_surat from the found model to the validated data
        // This prevents the "Attempt to read property..." error
        $validated['no_surat'] = $perihalSurat->id;



        // if ($request->hasFile('file_surat')) {
        //     $file = $request->file('file_surat');
        //     $fileName = time() . '_' . $file->getClientOriginalName();
        //     $validated['path'] = $file->storeAs('surat-keluar', $fileName, 'public');
        // }

        $validated['created_by'] = auth()->id();

        SuratKeluar::create($validated);

        return redirect()->route('admin.surat-keluar.index')
                        ->with('success', 'Surat keluar berhasil ditambahkan.');
    }

    public function show(SuratKeluar $suratKeluar)
    {
        $suratKeluar->load(['perihalSurat', 'creator']);
        return view('admin.surat-keluar.show', compact('suratKeluar'));
    }

    public function edit(SuratKeluar $suratKeluar)
    {
        $kepalaDesa = KepalaDesa::all();
        $perihalSurat = PerihalSurat::all();
        return view('admin.surat-keluar.edit', compact('suratKeluar', 'perihalSurat', 'kepalaDesa'));
    }

    public function update(Request $request, SuratKeluar $suratKeluar)
    {
        $validated = $request->validate([
            // 'no_surat' => 'required|string|max:255|unique:surat_keluar,no_surat,' . $suratKeluar->id,
            'tanggal' => 'required|date',
            'pengirim' => 'required|string|max:255',
            'nama_kades' => 'required|max:255|exists:kepaladesa,id',
            'perihal_surat_id' => 'required|exists:perihal_surat,id',
            // 'file_surat' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:5120',
        ]);

        // if ($request->hasFile('file_surat')) {
        //     // Delete old file
        //     if ($suratKeluar->path && Storage::disk('public')->exists($suratKeluar->path)) {
        //         Storage::disk('public')->delete($suratKeluar->path);
        //     }
            
        //     $file = $request->file('file_surat');
        //     $fileName = time() . '_' . $file->getClientOriginalName();
        //     $validated['path'] = $file->storeAs('surat-keluar', $fileName, 'public');
        // }

        $suratKeluar->update($validated);

        return redirect()->route('admin.surat-keluar.index')
                        ->with('success', 'Surat keluar berhasil diupdate.');
    }

    // public function destroy(SuratKeluar $suratKeluar)
    // {
    //     if ($suratKeluar->path && Storage::disk('public')->exists($suratKeluar->path)) {
    //         Storage::disk('public')->delete($suratKeluar->path);
    //     }
        
    //     $suratKeluar->delete();

    //     return redirect()->route('admin.surat-keluar.index')
    //                     ->with('success', 'Surat keluar berhasil dihapus.');
    // }

//     public function download(SuratKeluar $suratKeluar)
//     {
//         if ($suratKeluar->path && Storage::disk('public')->exists($suratKeluar->path)) {
//             return Storage::disk('public')->download($suratKeluar->path, $suratKeluar->file_name);
//         }

//         return redirect()->back()->with('error', 'File tidak ditemukan.');
//     }

public function approve(SuratKeluar $suratKeluar)
{
    // Cek status saat ini
    if ($suratKeluar->status === 'disetujui' || $suratKeluar->status === 'ditolak') {
        return redirect()->back()->with('error', 'Status surat sudah dikonfirmasi dan tidak dapat diubah.');
    }
    
    // Perbarui status menjadi 'disetujui'
    $suratKeluar->status = 'disetujui';
    $suratKeluar->save();

    return redirect()->back()->with('success', 'Surat berhasil disetujui.');
}

public function reject(SuratKeluar $suratKeluar)
{
    // Cek status saat ini
    if ($suratKeluar->status === 'disetujui' || $suratKeluar->status === 'ditolak') {
        return redirect()->back()->with('error', 'Status surat sudah dikonfirmasi dan tidak dapat diubah.');
    }
    
    // Perbarui status menjadi 'ditolak'
    $suratKeluar->status = 'ditolak';
    $suratKeluar->save();

    return redirect()->back()->with('success', 'Surat berhasil ditolak.');
}

public function cetak(SuratKeluar $suratKeluar)
    {
        // Load relasi yang diperlukan
        $suratKeluar->load(['perihalSurat', 'kepalaDesa', 'creator']);
        
        // Prepare data untuk template PDF
        $data = [
            'nama' => $suratKeluar->pengirim,
            'nik' => $suratKeluar->creator?->nik ?? 'NIK tidak tersedia',
            'ttl' => $suratKeluar->creator?->alamat_tanggallahir ?? 'TTL tidak tersedia',
            'alamat' => $suratKeluar->creator?->alamat_tanggallahir ?? 'Alamat tidak tersedia',
            'no_surat' => $suratKeluar->perihalSurat?->no_surat ?? 'No surat tidak tersedia',
            'kepala_desa' => $suratKeluar->kepalaDesa?->nama_kades ?? 'SUKIMAN',
            'tanggal_surat' => $suratKeluar->tanggal,
            'perihal' => $suratKeluar->perihalSurat?->deskripsi ?? 'Keterangan Tidak Mampu'
        ];

        // Generate PDF
        $pdf = Pdf::loadView('laporan.template_surat_new', $data)->setPaper('A4');
        
        // Clear any output buffers
        ob_end_clean();

        $fileName = 'surat_'.$data['nama'].'_'.time().'.pdf';

        return response($pdf->output(), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="'.$fileName.'"',
            'Cache-Control' => 'no-cache, must-revalidate',
            'Pragma' => 'no-cache',
            'Expires' => '0',
        ]);
    }
}