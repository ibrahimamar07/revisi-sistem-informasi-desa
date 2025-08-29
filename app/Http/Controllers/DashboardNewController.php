<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penduduk;

class DashboardNewController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:pengguna');
    }

    public function index()
{
    $totalPenduduk = Penduduk::count();
    $lakiLaki = Penduduk::where('jenis_kelamin', 'L')->count();
    $perempuan = Penduduk::where('jenis_kelamin', 'P')->count();
    $penduduk = Penduduk::paginate(10);

    return view('penduduk.dashboard', compact('totalPenduduk', 'lakiLaki', 'perempuan', 'penduduk'));
}
}