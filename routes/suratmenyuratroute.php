<?php
// routes/web.php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SuratMasukController;
use App\Http\Controllers\SuratKeluarController;
use App\Http\Controllers\SuratMasukTendikController;
use App\Http\Controllers\SuratKeluarTendikController;
use App\Http\Controllers\PerihalSuratController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LaporanController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Authentication Routes
// Route::get('/', function () {
//     return redirect()->route('login');
// });
Route::prefix('web-a')->name('web-a.')->group(function () {
    Route::get('/', function () {
        return redirect()->route('login');
    });
});



Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register/suratmenyurat', [AuthController::class, 'showRegister'])->name('register.suratmenyurat');
Route::post('/register/suratmenyurat', [AuthController::class, 'register'])->name('register.submit.suratmenyurat');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

//Protected Routes

Route::middleware('auth')->group(function () {

    // Admin PPTK Routes
    Route::middleware('role:admin_pptk')->group(function () {
        Route::prefix('admin')->name('admin.')->group(function () {

            // Dashboard
            Route::get('/dashboard', [DashboardController::class, 'adminDashboard'])->name('dashboard');

            // Perihal Surat
            Route::resource('perihal-surat', PerihalSuratController::class);

            // Surat Masuk
            // Route::resource('surat-masuk', SuratMasukController::class);
            // Route::get('surat-masuk/{suratMasuk}/download', [SuratMasukController::class, 'download'])->name('surat-masuk.download');

            // Surat Keluar
            Route::resource('surat-keluar', SuratKeluarController::class);
            Route::get('surat-keluar/{suratKeluar}/download', [SuratKeluarController::class, 'download'])->name('surat-keluar.download');
             Route::post('/{suratKeluar}/approve', [SuratKeluarController::class, 'approve'])->name('approve');
            Route::post('/{suratKeluar}/reject', [SuratKeluarController::class, 'reject'])->name('reject');

            // Users Management
            Route::resource('users', UserController::class);

            // Laporan
            // Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
            // Route::post('/laporan/cetak', [LaporanController::class, 'cetak'])->name('laporan.cetak');
        });
    });

    // Tenaga Pendidik Routes
    Route::middleware('role:tenaga_pendidik')->group(function () {
        Route::prefix('Perangkat Desa 1')->name('tenaga-pendidik.')->group(function () {
            
            // Dashboard
            Route::get('/dashboard', [DashboardController::class, 'tenagaPendidikDashboard'])->name('dashboard');

        //    Route::resource('surat-masuk', SuratMasukTendikController::class);
        //     Route::get('surat-masuk/{suratMasuk}/download', [SuratMasukTendikController::class, 'download'])->name('surat-masuk.download');
 
            // Surat Keluar
            Route::resource('surat-keluar', SuratKeluarTendikController::class);
            Route::get('surat-keluar/{suratKeluar}/download', [SuratKeluarTendikController::class, 'download'])->name('surat-keluar.download');

            // // Laporan
            // Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
            // Route::post('/laporan/cetak', [LaporanController::class, 'cetak'])->name('laporan.cetak');

            // Profile
            Route::get('/profile', function () {
                return view('tenaga-pendidik.profile.index');
            })->name('profile.index');
        });
    });
    // Route laporan bisa diakses oleh semua role yang sudah login
    Route::middleware('auth')->group(function () {
        // Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
        // Route::post('/laporan/cetak', [LaporanController::class, 'cetak'])->name('laporan.cetak');
        Route::get('/laporan', [App\Http\Controllers\SuratController::class, 'form'])->name('laporan.index');
        Route::post('/laporan/cetak', [App\Http\Controllers\SuratController::class, 'generate'])->name('laporan.cetak');

    });
});