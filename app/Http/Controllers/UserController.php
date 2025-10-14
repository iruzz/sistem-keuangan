<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    // 📖 Tampil semua user
    public function baca()
    {
        $data = User::with('roles')->get();
        return view('pages.superadmin.user.baca', compact('data'));
    }

    // ➕ Form tambah user
    public function create()
    {
        $roles = Role::all();
        return view('pages.superadmin.user.create', compact('roles'));
    }

    // 💾 Simpan user baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
            'role'     => 'required'
        ]);

        $user = User::create([
            'name'     => $validated['name'],
            'email'    => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        $user->assignRole($validated['role']);

        return redirect()->route('superadmin.users')->with('success', 'User baru berhasil ditambahkan!');
    }

    // ✏️ Form edit user
    public function edit($id)
    {
        $user = User::with('roles')->findOrFail($id);
        $roles = Role::all();
        return view('pages.superadmin.user.edit', compact('user', 'roles'));
    }

    // 🔄 Update data user
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|min:6|confirmed',
            'role'     => 'required'
        ]);

        // Update field dasar
        $user->name  = $validated['name'];
        $user->email = $validated['email'];

        // Update password jika diisi
        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        // Hapus role lama dan tambahkan role baru
        $user->syncRoles([$validated['role']]);

        return redirect()->route('superadmin.users')->with('success', 'Data user berhasil diperbarui!');
    }

    // 🗑️ Hapus user
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('superadmin.users')->with('success', 'User berhasil dihapus!');
    }
}
