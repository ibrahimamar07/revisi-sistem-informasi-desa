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
            // Hitung jumlah berdasarkan status
            $permohonanSuratBelumDikonfirmasi = SuratKeluar::where('status', 'belum_dikonfirmasi')->count();
            $permohonanSuratDisetujui         = SuratKeluar::where('status', 'disetujui')->count();
            $permohonanSuratDitolak           = SuratKeluar::where('status', 'ditolak')->count();

            // Kirim ke view
            $view->with([
                'permohonanSuratBelumDikonfirmasi' => $permohonanSuratBelumDikonfirmasi,
                'permohonanSuratDisetujui'         => $permohonanSuratDisetujui,
                'permohonanSuratDitolak'           => $permohonanSuratDitolak,
            ]);
        });
    }
}
