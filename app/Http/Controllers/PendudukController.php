<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penduduk;

class PendudukController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:pengguna');
        $this->middleware('admin')->except(['index', 'show']);
    }

    public function index()
    {
        $penduduk = Penduduk::paginate(10);
        return view('penduduk.index', compact('penduduk'));
    }

    public function create()
    {
        return view('penduduk.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nik' => 'required|string|size:16|unique:penduduk',
            'nama' => 'required|string|max:255',
            'alamat_tanggallahir' => 'required|string',
            'jenis_kelamin' => 'required|in:L,P',
            'agama' => 'required|string|max:255',
        ]);

        Penduduk::create($request->all());

        return redirect()->route('penduduk.index')->with('success', 'Data penduduk berhasil ditambahkan.');
    }

    public function show(Penduduk $penduduk)
    {
        return view('penduduk.show', compact('penduduk'));
    }

    public function edit(Penduduk $penduduk)
    {
        return view('penduduk.edit', compact('penduduk'));
    }

    public function update(Request $request, Penduduk $penduduk)
    {
        $request->validate([
            'nik' => 'required|string|size:16|unique:penduduk,nik,' . $penduduk->id,
            'nama' => 'required|string|max:255',
            'alamat_tanggallahir' => 'required|string',
            'jenis_kelamin' => 'required|in:L,P',
            'agama' => 'required|string|max:255',
        ]);

        $penduduk->update($request->all());

        return redirect()->route('penduduk.index')->with('success', 'Data penduduk berhasil diperbarui.');
    }

    public function destroy(Penduduk $penduduk)
    {
        $penduduk->delete();
        return redirect()->route('penduduk.index')->with('success', 'Data penduduk berhasil dihapus.');
    }
}