<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SuratMasuk;
use App\Models\SuratKeluar;
use App\Models\User;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function adminDashboard()
    {
        $totalSuratMasuk = SuratMasuk::count();
        $totalSuratKeluar = SuratKeluar::count();
        $suratMasukBulanIni = SuratMasuk::whereMonth('created_at', Carbon::now()->month)->count();
        $suratKeluarBulanIni = SuratKeluar::whereMonth('created_at', Carbon::now()->month)->count();
        
        $suratMasukTerbaru = SuratMasuk::with(['perihalSurat', 'creator'])
                                       ->latest()
                                       ->take(2)
                                       ->get();
        
        $suratKeluarTerbaru = SuratKeluar::with(['perihalSurat', 'creator'])
                                         ->latest()
                                         ->take(2)
                                         ->get();

        return view('admin.dashboard', compact(
            'totalSuratMasuk', 'totalSuratKeluar', 
            'suratMasukBulanIni', 'suratKeluarBulanIni',
            'suratMasukTerbaru', 'suratKeluarTerbaru'
        ));
    }

    public function tenagaPendidikDashboard()
    {
        $totalSuratMasuk = SuratMasuk::count();
        $totalSuratKeluar = SuratKeluar::count();
        
        return view('tenaga-pendidik.dashboard', compact(
            'totalSuratMasuk', 'totalSuratKeluar'
        ));
    }
}
