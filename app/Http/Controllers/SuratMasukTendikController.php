<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SuratMasuk;
use App\Models\PerihalSurat;
use Illuminate\Support\Facades\Storage;

class SuratMasukTendikController extends Controller
{
     public function index(Request $request)
{
    $query = SuratMasuk::with(['perihalSurat', 'creator'])->latest();

    if ($request->filled('q')) {
        $search = $request->q;
        $query->where(function ($q) use ($search) {
            $q->where('no_surat', 'like', "%$search%")
              ->orWhereHas('perihalSurat', function ($q2) use ($search) {
                  $q2->where('deskripsi', 'like', "%$search%");
              })
              ->orWhereDate('tanggal', $search);
        });
    }

    $suratMasuk = $query->paginate(15)->withQueryString();

    return view('tenaga-pendidik.surat-masuk.index', compact('suratMasuk'));
}

    public function create()
    {
        $perihalSurat = PerihalSurat::all();
        return view('tenaga-pendidik.surat-masuk.create', compact('perihalSurat'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'no_surat' => 'required|string|max:255|unique:surat_masuk',
            'tanggal' => 'required|date',
            'perihal_surat_id' => 'required|exists:perihal_surat,id',
            'file_surat' => 'required|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:5120', // 5MB max
        ]);

        if ($request->hasFile('file_surat')) {
            $file = $request->file('file_surat');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $validated['path'] = $file->storeAs('surat-masuk', $fileName, 'public');
        }

        $validated['created_by'] = auth()->id();

        SuratMasuk::create($validated);

        return redirect()->route('tenaga-pendidik.surat-masuk.index')
                        ->with('success', 'Surat masuk berhasil ditambahkan.');
    }

    public function show(SuratMasuk $suratMasuk)
    {
        $suratMasuk->load(['perihalSurat', 'creator']);
        return view('tenaga-pendidik.surat-masuk.show', compact('suratMasuk'));
    }

    public function edit(SuratMasuk $suratMasuk)
    {
        $perihalSurat = PerihalSurat::all();
        return view('tenaga-pendidik.surat-masuk.edit', compact('suratMasuk', 'perihalSurat'));
    }

    public function update(Request $request, SuratMasuk $suratMasuk)
    {
        $validated = $request->validate([
            'no_surat' => 'required|string|max:255|unique:surat_masuk,no_surat,' . $suratMasuk->id,
            'tanggal' => 'required|date',
            'perihal_surat_id' => 'required|exists:perihal_surat,id',
            'file_surat' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:5120',
        ]);

        if ($request->hasFile('file_surat')) {
            // Delete old file
            if ($suratMasuk->path && Storage::disk('public')->exists($suratMasuk->path)) {
                Storage::disk('public')->delete($suratMasuk->path);
            }
            
            $file = $request->file('file_surat');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $validated['path'] = $file->storeAs('surat-masuk', $fileName, 'public');
        }

        $suratMasuk->update($validated);

        return redirect()->route('tenaga-pendidik.surat-masuk.index')
                        ->with('success', 'Surat masuk berhasil diupdate.');
    }

    public function destroy(SuratMasuk $suratMasuk)
    {
        if ($suratMasuk->path && Storage::disk('public')->exists($suratMasuk->path)) {
            Storage::disk('public')->delete($suratMasuk->path);
        }
        
        $suratMasuk->delete();

        return redirect()->route('tenaga-pendidik.surat-masuk.index')
                        ->with('success', 'Surat masuk berhasil dihapus.');
    }

    public function download(SuratMasuk $suratMasuk)
    {
        if ($suratMasuk->path && Storage::disk('public')->exists($suratMasuk->path)) {
            return Storage::disk('public')->download($suratMasuk->path, $suratMasuk->file_name);
        }

        return redirect()->back()->with('error', 'File tidak ditemukan.');
    }
}
