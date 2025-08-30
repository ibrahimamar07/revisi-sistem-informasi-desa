<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SuratKeluar;
use App\Models\PerihalSurat;
use Illuminate\Support\Facades\Storage;

class SuratKeluarTendikController extends Controller
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

    return view('tenaga-pendidik.surat-keluar.index', compact('suratKeluar'));
}

    public function create()
    {
        $perihalSurat = PerihalSurat::all();
        return view('tenaga-pendidik.surat-keluar.create', compact('perihalSurat'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'no_surat' => 'required|string|max:255|unique:surat_keluar',
            'tanggal' => 'required|date',
            'pengirim' => 'required|string|max:255',
            'perihal_surat_id' => 'required|exists:perihal_surat,id',
            // 'file_surat' => 'required|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:5120', // 5MB max
        ]);

        // if ($request->hasFile('file_surat')) {
        //     $file = $request->file('file_surat');
        //     $fileName = time() . '_' . $file->getClientOriginalName();
        //     $validated['path'] = $file->storeAs('surat-keluar', $fileName, 'public');
        // }

        $validated['created_by'] = auth()->id();

        SuratKeluar::create($validated);

        return redirect()->route('tenaga-pendidik.surat-keluar.index')
                        ->with('success', 'Permohonan berhasil ditambahkan.');
    }

    public function show(SuratKeluar $suratKeluar)
    {
        $suratKeluar->load(['perihalSurat', 'creator']);
        return view('tenaga-pendidik.surat-keluar.show', compact('suratKeluar'));
    }

    public function edit(SuratKeluar $suratKeluar)
    {
        $perihalSurat = PerihalSurat::all();
        return view('tenaga-pendidik.surat-keluar.edit', compact('suratKeluar', 'perihalSurat'));
    }

    public function update(Request $request, SuratKeluar $suratKeluar)
    {
        $validated = $request->validate([
            'no_surat' => 'required|string|max:255|unique:surat_keluar,no_surat,' . $suratKeluar->id,
            'tanggal' => 'required|date',
            'pengirim' => 'required|string|max:255',
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

        return redirect()->route('tenaga-pendidik.surat-keluar.index')
                        ->with('success', 'Permohonan Surat berhasil diupdate.');
    }

    public function destroy(SuratKeluar $suratKeluar)
    {
        if ($suratKeluar->path && Storage::disk('public')->exists($suratKeluar->path)) {
            Storage::disk('public')->delete($suratKeluar->path);
        }
        
        $suratKeluar->delete();

        return redirect()->route('tenaga-pendidik.surat-keluar.index')
                        ->with('success', 'Permohonan Surat berhasil dihapus.');
    }

    public function download(SuratKeluar $suratKeluar)
    {
        if ($suratKeluar->path && Storage::disk('public')->exists($suratKeluar->path)) {
            return Storage::disk('public')->download($suratKeluar->path, $suratKeluar->file_name);
        }

        return redirect()->back()->with('error', 'File tidak ditemukan.');
    }
}