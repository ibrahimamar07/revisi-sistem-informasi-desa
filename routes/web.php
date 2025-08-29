<?php
// routes/web.php
use Illuminate\Support\Facades\Route;
require __DIR__.'/suratmenyuratroute.php';
require __DIR__.'/pendudukroute.php';


Route::get('/', function () {
    return view('portal.portal'); // halaman pilihan web A atau web B
})->name('portal.portal');