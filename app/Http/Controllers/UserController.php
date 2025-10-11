<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Spatie\Permission\Models\Role; // ✅ Tambahin ini bro

class UserController extends Controller
{
    public function baca() {
        $data = User::with('roles')->get();
        return view('pages.superadmin.user.baca', compact('data'));
    }

     public function create()
    {
        $roles = Role::all();
        return view('pages.superadmin.user.create', compact('roles'));
    }

    // Simpan user baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
            'role'     => 'required',
            'foto'     => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Upload foto jika ada
        $namaFileFoto = null;
        if ($request->hasFile('foto')) {
            $namaFileFoto = time() . '_' . $request->file('foto')->getClientOriginalName();
            $request->file('foto')->storeAs('public/foto_user', $namaFileFoto);
        }

        // Buat user baru
        $user = User::create([
            'name'           => $validated['name'],
            'email'          => $validated['email'],
            'password'       => Hash::make($validated['password']),
            'nama_file_foto' => $namaFileFoto,
        ]);

        // Tambahkan role
        $user->assignRole($validated['role']);

        return redirect()->route('superadmin.users')
            ->with('success', 'User baru berhasil ditambahkan!');
    }
}
