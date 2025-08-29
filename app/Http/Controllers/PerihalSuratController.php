<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PerihalSurat;

class PerihalSuratController extends Controller
{
    public function index(Request $request)
{
    $query = PerihalSurat::withCount(['suratMasuk', 'suratKeluar']);

    if ($search = $request->input('search')) {
        $query->where('deskripsi', 'like', '%' . $search . '%');
    }

    $perihalSurat = $query->orderBy('created_at', 'desc')->paginate(10)->withQueryString();

    return view('admin.perihal-surat.index', compact('perihalSurat'));
}


    public function create()
    {
        return view('admin.perihal-surat.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'deskripsi' => 'required|string',
        ]);

        PerihalSurat::create($validated);

        return redirect()->route('admin.perihal-surat.index')
                        ->with('success', 'Perihal surat berhasil ditambahkan.');
    }

    public function show(PerihalSurat $perihalSurat)
    {
        return view('admin.perihal-surat.show', compact('perihalSurat'));
    }

    public function edit(PerihalSurat $perihalSurat)
    {
        return view('admin.perihal-surat.edit', compact('perihalSurat'));
    }

    public function update(Request $request, PerihalSurat $perihalSurat)
    {
        $validated = $request->validate([
            'deskripsi' => 'required|string',
        ]);

        $perihalSurat->update($validated);

        return redirect()->route('admin.perihal-surat.index')
                        ->with('success', 'Perihal surat berhasil diupdate.');
    }

    public function destroy(PerihalSurat $perihalSurat)
    {
        $perihalSurat->delete();

        return redirect()->route('admin.perihal-surat.index')
                        ->with('success', 'Perihal surat berhasil dihapus.');
    }
}