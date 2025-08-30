<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class SuratController extends Controller
{
    public function form()
    {
        return view('laporan.index');
    }

    public function generate(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required|string',
            'nik' => 'required|numeric',
            'ttl' => 'required|string',
            'jk' => 'required|string',
            'pekerjaan' => 'required|string',
            'agama' => 'required|string',
            'alamat' => 'required|string',
        ]);

       $pdf = Pdf::loadView('laporan.template_surat', $data)->setPaper('A4');

    ob_end_clean();

    $fileName = 'surat_'.$data['nama'].'_'.time().'.pdf';

    return response($pdf->output(), 200, [
        'Content-Type' => 'application/pdf',
        'Content-Disposition' => 'attachment; filename="'.$fileName.'"',
        'Cache-Control' => 'no-cache, must-revalidate',
        'Pragma' => 'no-cache',
        'Expires' => '0',
    ]);
    }
}

