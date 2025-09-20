<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengguna;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
{
    $query = Pengguna::query();

    if ($request->filled('search')) {
        $query->where('nama', 'like', '%' . $request->search . '%')
              ->orWhere('email', 'like', '%' . $request->search . '%')
              ->orWhere('role', 'like', '%' . $request->search . '%');
    }

    $users = $query->orderBy('created_at', 'desc')->paginate(10)->withQueryString();

    return view('admin.users.index', compact('users'));
}


    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:pengguna'],
            'nomor_hp' => ['required', 'string', 'max:15'],
            'nik'=> [
                'required_if:role,warga', // wajib jika role warga
                'nullable','string','max:16','unique:pengguna','regex:/^[0-9]{16}$/'
            ],
            'no_kk'=> [
                'required_if:role,warga', // wajib jika role warga
                'nullable','string','max:16','regex:/^[0-9]{16}$/'
            ],
            'role' => ['required', 'string', 'in:admin,perangkatdesa,warga'],
            'alamat_tanggallahir' => ['required', 'string'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $validated['password'] = Hash::make($request->password);

        Pengguna::create($validated);

        return redirect()->route('admin.users.index')->with('success', 'Akun berhasil ditambahkan.');
    }

        public function show(Pengguna $user)
    {
        return view('admin.users.show', compact('user'));
    }


    public function edit(Pengguna $user)
    {
        return view('admin.users.edit', compact('user'));
    }

public function update(Request $request, Pengguna $user)
{
    $validated = $request->validate([
        'nama' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:pengguna,email,' . $user->id],
        'nomor_hp' => ['required', 'string', 'max:15'],
        'nik' => ['nullable', 'string', 'max:16', 'unique:pengguna,nik,' . $user->id, 'regex:/^[0-9]{16}$/'],
        'no_kk' => ['nullable', 'string', 'max:16', 'regex:/^[0-9]{16}$/'],
        'alamat_tanggallahir' => ['required', 'string'],
        'role' => ['required', 'string', 'in:admin,perangkatdesa,warga'],
        'password' => ['required', 'string', 'min:8'],
    ]);

    if ($request->filled('password')) {
        $validated['password'] = Hash::make($request->password);
    } else {
        unset($validated['password']);
    }

    $user->update($validated);

    return redirect()->route('admin.users.index')->with('success', 'Akun berhasil diperbarui.');
}

    public function destroy(Pengguna $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'Akun berhasil dihapus.');
    }
}
