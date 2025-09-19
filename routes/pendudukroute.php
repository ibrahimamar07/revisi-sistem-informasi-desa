<?php
// use App\Http\Controllers\AuthNewController;
// use App\Http\Controllers\DashboardNewController;
// use App\Http\Controllers\PendudukController;
// use App\Http\Controllers\PenggunaController;
// use Illuminate\Support\Facades\Route;

// // Halaman login dan register
// Route::prefix('web-b')->name('web-b.')->group(function () {
//     Route::get('/', function () {
//         return redirect()->route('loginpenduduk');
//     });
// });


// Route::middleware(['web', \App\Http\Middleware\SetPendudukSession::class])->group(function () {
//     // .................
// Route::get('/loginpenduduk', [AuthNewController::class, 'showLogin'])->name('loginpenduduk');
// Route::post('/loginpenduduk', [AuthNewController::class, 'login'])->name('login.submit');

// Route::get('/register', [AuthNewController::class, 'showRegister'])->name('register');
// Route::post('/register', [AuthNewController::class, 'register'])->name('register.submit');

// // Logout
// Route::post('/logoutpenduduk', [AuthNewController::class, 'logout'])->name('logoutpenduduk');

// // Dashboard untuk pengguna yang sudah login
// Route::middleware('auth:pengguna')->group(function () {
//     Route::get('/dashboard', [DashboardNewController::class, 'index'])->name('dashboard');

//     // Penduduk (hanya admin yang bisa create/edit/delete)
//     Route::resource('penduduk', PendudukController::class);
// //    Route::get('/penduduk/multi-create', [PendudukController::class, 'multiCreate'])->name('penduduk.multi.create');
// //    Route::post('/penduduk/multi-store', [PendudukController::class, 'multiStore'])->name('penduduk.multi.store');



//     // Profil Pengguna
//     Route::get('/profile', [PenggunaController::class, 'show'])->name('user.profile');
//     Route::put('/profile', [PenggunaController::class, 'update'])->name('user.profile.update');
// });
// });
