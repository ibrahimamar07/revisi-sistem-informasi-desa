<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SuratMasuk;
use App\Models\SuratKeluar;
use App\Models\PerihalSurat;
use Illuminate\Support\Facades\Storage;

class LaporanController extends Controller
{
    public function index()
    {
        return view('laporan.index');
    }

    public function cetak(Request $request)
    {
        $request->validate([
            'jenis_surat' => 'required|in:masuk,keluar',
            'nomor' => 'required',
            'tanggal' => 'required|date',
        ]);

        if ($request->jenis_surat === 'masuk') {
            $data = SuratMasuk::where('no_surat', $request->nomor)
                ->whereDate('tanggal', $request->tanggal)
                ->first();
        } else {
            $data = SuratKeluar::where('no_surat', $request->nomor)
                ->whereDate('tanggal', $request->tanggal)
                ->first();
        }

        if (!$data || !$data->path || !Storage::disk('public')->exists($data->path)) {
            return back()->with('error', 'File tidak ditemukan.');
        }

        $filename = basename($data->path);
        $relativePath = str_replace('storage/', '', $data->path);

        // Menggunakan response()->download() untuk mengunduh file dari storage publik
        $filePath = storage_path('app/public/' . $relativePath);
        if (!file_exists($filePath)) {
            // File tidak ditemukan di direktori storage
            return back()->with('error', 'File tidak ditemukan di storage.');
        }
        return response()->download($filePath, $filename);
    }
}