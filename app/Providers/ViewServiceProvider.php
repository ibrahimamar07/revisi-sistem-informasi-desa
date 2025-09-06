<?php
// app/Providers/ViewServiceProvider.php
namespace App\Providers;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Models\SuratKeluar; 

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Daftarkan layanan aplikasi.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstraps layanan aplikasi.
     */
    public function boot(): void
    {
        View::composer('layouts.app', function ($view) {
            $permohonanSuratBelumDikonfirmasi = SuratKeluar::where('status', 'belum_dikonfirmasi')->count();
            $permohonanSuratDisetujui = SuratKeluar::where('status', 'disetujui')->count();
            $permohonanSuratDitolak = SuratKeluar::where('status', 'ditolak')->count();
            
            $view->with('permohonanSuratBelumDikonfirmasi', $permohonanSuratBelumDikonfirmasi)
                 ->with('permohonanSuratDisetujui', $permohonanSuratDisetujui)
                 ->with('permohonanSuratDitolak', $permohonanSuratDitolak);
        });
    }

}