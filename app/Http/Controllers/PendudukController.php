<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penduduk;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PendudukController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:pengguna');
        $this->middleware('admin')->except(['index', 'show']);
    }

    public function index()
    {
        $penduduk = Penduduk::paginate(10);
        return view('penduduk.index', compact('penduduk'));
    }

    public function create()
    {
        return view('penduduk.multi-create');
    }

    public function store(Request $request)
    {
        // kanggo debug ojo dihapus
        Log::info('Request data:', $request->all());

        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'penduduk.*.nik' => 'required|string|size:16|unique:penduduk,nik',
            'penduduk.*.nama' => 'required|string|max:255',
            'penduduk.*.jenis_kelamin' => 'required|in:L,P',
            'penduduk.*.agama' => 'required|string|max:50',
            'penduduk.*.alamat_tanggallahir' => 'required|string',
        ]);

        $validator->after(function ($validator) use ($request) {
            if ($request->has('penduduk')) {
                foreach ($request->penduduk as $index => $data) {
                    $rowNumber = $index + 1;
                    
                    if (empty($data['nik'])) {
                        $validator->errors()->add("row_{$index}_nik", "Baris {$rowNumber}: NIK harus diisi");
                    } elseif (strlen($data['nik']) !== 16) {
                        $validator->errors()->add("row_{$index}_nik", "Baris {$rowNumber}: NIK harus tepat 16 karakter");
                    } elseif (!is_numeric($data['nik'])) {
                        $validator->errors()->add("row_{$index}_nik", "Baris {$rowNumber}: NIK hanya boleh berisi angka");
                    } elseif (\App\Models\Penduduk::where('nik', $data['nik'])->exists()) {
                        $validator->errors()->add("row_{$index}_nik", "Baris {$rowNumber}: NIK {$data['nik']} sudah terdaftar");
                    }
                    
                    if (empty($data['nama'])) {
                        $validator->errors()->add("row_{$index}_nama", "Baris {$rowNumber}: Nama harus diisi");
                    } elseif (strlen($data['nama']) > 255) {
                        $validator->errors()->add("row_{$index}_nama", "Baris {$rowNumber}: Nama terlalu panjang (maksimal 255 karakter)");
                    }
                  
                    if (empty($data['jenis_kelamin'])) {
                        $validator->errors()->add("row_{$index}_jk", "Baris {$rowNumber}: Jenis kelamin harus dipilih");
                    } elseif (!in_array($data['jenis_kelamin'], ['L', 'P'])) {
                        $validator->errors()->add("row_{$index}_jk", "Baris {$rowNumber}: Jenis kelamin tidak valid");
                    }
                    
                    
                    if (empty($data['agama'])) {
                        $validator->errors()->add("row_{$index}_agama", "Baris {$rowNumber}: Agama harus dipilih");
                    }
                    
                    
                    if (empty($data['alamat_tanggallahir'])) {
                        $validator->errors()->add("row_{$index}_alamat", "Baris {$rowNumber}: Alamat dan tanggal lahir harus diisi");
                    }
                }
            }
        });

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput()
                ->with('old_penduduk_data', $request->penduduk);
        }

        try {
            DB::beginTransaction();
            
            $successCount = 0;
            $savedData = [];
            
            foreach ($request->penduduk as $index => $data) {
                if (!empty($data['nik']) && !empty($data['nama'])) {
                    $penduduk = Penduduk::create([
                        'nik' => $data['nik'],
                        'nama' => $data['nama'],
                        'jenis_kelamin' => $data['jenis_kelamin'],
                        'agama' => $data['agama'],
                        'alamat_tanggallahir' => $data['alamat_tanggallahir'],
                    ]);
                    
                    $savedData[] = $penduduk;
                    $successCount++;
                }
            }
            
            DB::commit();
            
            return redirect()->route('penduduk.index')->with('success', "Berhasil menambahkan {$successCount} data penduduk.");
            
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error saving penduduk data: ' . $e->getMessage());
            
            return back()
                ->withErrors(['database_error' => 'Terjadi kesalahan database: ' . $e->getMessage()])
                ->withInput()
                ->with('old_penduduk_data', $request->penduduk);
        }
    }

    public function show(Penduduk $penduduk)
    {
        return view('penduduk.show', compact('penduduk'));
    }

    public function edit(Penduduk $penduduk)
    {
        return view('penduduk.edit', compact('penduduk'));
    }

    public function update(Request $request, Penduduk $penduduk)
    {
        $request->validate([
            'nik' => 'required|string|size:16|unique:penduduk,nik,' . $penduduk->id,
            'nama' => 'required|string|max:255',
            'alamat_tanggallahir' => 'required|string',
            'jenis_kelamin' => 'required|in:L,P',
            'agama' => 'required|string|max:255',
        ]);

        $penduduk->update($request->all());

        return redirect()->route('penduduk.index')->with('success', 'Data penduduk berhasil diperbarui.');
    }

    public function destroy(Penduduk $penduduk)
    {
        $penduduk->delete();
        return redirect()->route('penduduk.index')->with('success', 'Data penduduk berhasil dihapus.');
    }
}