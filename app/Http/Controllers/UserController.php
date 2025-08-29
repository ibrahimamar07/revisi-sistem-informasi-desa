<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
{
    $query = User::query();

    if ($request->filled('search')) {
        $query->where('name', 'like', '%' . $request->search . '%')
              ->orWhere('username', 'like', '%' . $request->search . '%')
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
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:4',
            'role' => 'required|in:admin_pptk,tenaga_pendidik',
        ]);

        $validated['password'] = $request->password; 

        User::create($validated);

        return redirect()->route('admin.users.index')->with('success', 'Akun berhasil ditambahkan.');
    }

        public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }


    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'role' => 'required|in:admin_pptk,tenaga_pendidik',
        ]);

        if ($request->filled('password')) {
    $validated['password'] = $request->password; // Tanpa Hash
}


        $user->update($validated);

        return redirect()->route('admin.users.index')->with('success', 'Akun berhasil diperbarui.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'Akun berhasil dihapus.');
    }
}
