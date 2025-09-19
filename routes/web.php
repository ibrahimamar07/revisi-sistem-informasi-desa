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

    Route::get('/dashboard', [DashboardNewController::class, 'index'])->name('dashboard');

   Route::get('/penduduk', [PendudukController::class, 'index'])->name('penduduk.index');

    // Profil Pengguna
    Route::get('/profile', [PenggunaController::class, 'show'])->name('user.profile');
    Route::put('/profile', [PenggunaController::class, 'update'])->name('user.profile.update');
    Route::middleware(['role:admin'])->group(function () {
    // Penduduk (hanya admin yang bisa create/edit/delete)
    Route::resource('penduduk', PendudukController::class, ['except'=> ['index']])->names('penduduk');
//    Route::get('/penduduk/multi-create', [PendudukController::class, 'multiCreate'])->name('penduduk.multi.create');
//    Route::post('/penduduk/multi-store', [PendudukController::class, 'multiStore'])->name('penduduk.multi.store');
});
});
});
