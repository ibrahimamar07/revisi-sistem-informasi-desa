
<?php
// routes/web.php
use Illuminate\Support\Facades\Route;
// require __DIR__.'/suratmenyuratroute.php';
// require __DIR__.'/pendudukroute.php';


// Route::get('/', function () {
//     return view('portal.portal'); // halaman pilihan web A atau web B
// })->name('portal.portal');

use App\Http\Controllers\AuthNewController;
use App\Http\Controllers\DashboardNewController;
use App\Http\Controllers\PendudukController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SuratMasukController;
use App\Http\Controllers\SuratKeluarController;
use App\Http\Controllers\SuratMasukTendikController;
use App\Http\Controllers\SuratKeluarTendikController;
use App\Http\Controllers\PerihalSuratController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KepalaDesaController;

// Halaman login dan register

    Route::get('/', function () {
        return redirect()->route('loginpenduduk');
    });


Route::middleware(['web', \App\Http\Middleware\SetPendudukSession::class])->group(function () {
    // .................
Route::get('/loginpenduduk', [AuthNewController::class, 'showLogin'])->name('loginpenduduk');
Route::post('/loginpenduduk', [AuthNewController::class, 'login'])->name('login.submit');

Route::get('/register', [AuthNewController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthNewController::class, 'register'])->name('register.submit');

// Logout
Route::post('/logoutpenduduk', [AuthNewController::class, 'logout'])->name('logoutpenduduk');


// Dashboard untuk pengguna yang sudah login
Route::middleware('auth:pengguna')->group(function () {
    
    Route::get('/portal', [AuthNewController::class, 'showportal'])->name('portal');

    //penduduk
    Route::get('/dashboard', [DashboardNewController::class, 'index'])->name('dashboard');
     Route::get('/dashboardsurat', [DashboardController::class, 'adminDashboard'])->name('dashboard.surat');

   Route::get('/penduduk', [PendudukController::class, 'index'])->name('penduduk.index');

    // Profil Pengguna
    // Route::get('/profile', [PenggunaController::class, 'show'])->name('user.profile');

    // Hanya perangkat desa yang bisa mengakses fitur berikut
    Route::middleware(['role:perangkatdesa'])->group(function () {
        Route::get('penduduk/export', [PendudukController::class, 'export'])->name('penduduk.export');
    Route::get('penduduk/import', [PendudukController::class, 'showImport'])->name('penduduk.show-import');
    Route::get('penduduk/template', [PendudukController::class, 'template'])->name('penduduk.template');
     Route::get('penduduk/guideimpor', [PendudukController::class, 'guideimpor'])->name('penduduk.guideimpor');

    Route::post('penduduk/import', [PendudukController::class, 'import'])->name('penduduk.import');
    route::get('/profile', [PenggunaController::class, 'show'])->name('user.profile');
     Route::put('/profile', [PenggunaController::class, 'update'])->name('user.profile.update');
    Route::resource('penduduk', PendudukController::class, ['except'=> ['index']])->names('penduduk');
});
//surat menyurat
Route::middleware('role:admin')->group(function () {
        Route::prefix('admin')->name('admin.')->group(function () {

            // Dashboard untuk admin
            Route::get('/dashboard', [DashboardController::class, 'adminDashboard'])->name('dashboard');

            // Perihal Surat
            Route::resource('perihal-surat', PerihalSuratController::class);
            // akun Management
            Route::resource('users', UserController::class);
        });
});
Route::middleware('role:warga')->group(function () {
        Route::prefix('warga')->name('tenaga-pendidik.')->group(function () {
            
            // Dashboard
            Route::get('/dashboard', [DashboardController::class, 'tenagaPendidikDashboard'])->name('dashboard');
            // Surat Keluar
            Route::resource('surat-keluar', SuratKeluarTendikController::class);

            // Profile
            Route::get('/profile', function () {
                return view('tenaga-pendidik.profile.index');
            })->name('profile.index');
        });
    });

    // Perangkat Desa Routes
Route::middleware('role:perangkatdesa')->group(function () {
        Route::prefix('perangkatdesa')->name('admin.')->group(function () {
            //arsip surat
         Route::get('/dashboard', [DashboardController::class, 'adminDashboard'])->name('dashboard');
         Route::resource('surat-keluar', SuratKeluarController::class);
             Route::post('/{suratKeluar}/approve', [SuratKeluarController::class, 'approve'])->name('approve');
            Route::post('/{suratKeluar}/reject', [SuratKeluarController::class, 'reject'])->name('reject');
            Route::resource('kepala-desa', KepalaDesaController::class);

});
});
Route::middleware('role:perangkatdesa')->group(function () {
Route::get('/admin/surat-keluar/{suratKeluar}/cetak', [SuratKeluarController::class, 'cetak'])
    ->name('admin.surat-keluar.cetak');

});

Route::middleware('role:perangkatdesa')->group(function () {
        Route::prefix('perangkatdesa')->name('perangkatdesa.')->group(function () {
             Route::get('/laporan', [App\Http\Controllers\SuratController::class, 'form'])->name('laporan.index');
        Route::post('/laporan/cetak', [App\Http\Controllers\SuratController::class, 'generate'])->name('laporan.cetak');
});
});
});
});
//