<?php

namespace App\Http\Controllers;

use App\Models\KepalaDesa;
use Illuminate\Http\Request;

class KepalaDesaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

        
       $kepalaDesa = KepalaDesa::latest()->paginate(10)->withQueryString();
        return view('admin.kepala-desa.index',compact('kepalaDesa'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.kepala-desa.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validated = $request->validate([
            'nama_kades' => 'required|string|max:255|unique:kepaladesa,nama_kades',
        ]);
        KepalaDesa::create($validated);
        return redirect()->route('admin.kepala-desa.index')->with('success', 'Kepala Desa berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KepalaDesa $kepalaDesa)
    {
        //
        return view('admin.kepala-desa.edit', compact('kepalaDesa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, KepalaDesa $kepalaDesa)
    {
        //
        $validated = $request->validate([
            'nama_kades' => 'required|string|max:255|unique:kepaladesa,nama_kades,' . $kepalaDesa->id,
        ]);
        $kepalaDesa->update($validated);
        return redirect()->route('admin.kepala-desa.index')->with('success', 'Kepala Desa berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KepalaDesa $kepalaDesa)
    {
        //
        
        $kepalaDesa->delete();
        return redirect()->route('admin.kepala-desa.index')->with('success', 'Kepala Desa berhasil dihapus.');
    }
}
