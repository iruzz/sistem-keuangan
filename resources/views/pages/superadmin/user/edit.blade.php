@extends('layouts.navbar')

@section('title', 'Edit Pengguna')
@section('page-title', 'Edit Pengguna')

@section('sidebar')
   <li>
      <a href="{{ route('superadmin.dashboard') }}"
         class="flex items-center p-2 text-gray-700 rounded-lg hover:bg-blue-50 hover:text-blue-600 group">
         <i class="fa-solid fa-house w-5 text-gray-500 group-hover:text-blue-600"></i>
         <span class="ms-3 font-medium">Dashboard</span>
      </a>
   </li>

   <li>
      <a href="{{ route('superadmin.users') }}"
         class="flex items-center p-2 text-gray-700 rounded-lg hover:bg-blue-50 hover:text-blue-600 group">
         <i class="fa-solid fa-user w-5 text-gray-500 group-hover:text-blue-600"></i>
         <span class="ms-3 font-medium">Users</span>
      </a>
   </li>

   <li>
      <a href="{{ route('superadmin.akun') }}"
         class="flex items-center p-2 text-gray-700 rounded-lg hover:bg-blue-50 hover:text-blue-600 group">
         <i class="fa-solid fa-wallet w-5 text-gray-500 group-hover:text-blue-600"></i>
         <span class="ms-3 font-medium">Akun Keuangan</span>
      </a>
   </li>

   <li>
      <a href="{{route('superadmin.kategori')}}"
         class="flex items-center p-2 text-gray-700 rounded-lg hover:bg-blue-50 hover:text-blue-600 group">
         <i class="fa-solid fa-tags w-5 text-gray-500 group-hover:text-blue-600"></i>
         <span class="ms-3 font-medium">Kategori Transaksi</span>
      </a>
   </li>
@endsection

@section('content')
<div class="max-w-2xl mx-auto bg-white shadow-md rounded-xl border border-gray-100 p-6 mt-6">
    <h2 class="text-xl font-semibold text-gray-800 mb-6">Edit Data Pengguna</h2>

    <form action="{{ route('superadmin.users.update', $user->id) }}" method="POST" class="space-y-5">
        @csrf
        @method('PUT')

        {{-- Nama --}}
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}"
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
                   required>
            @error('name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Email --}}
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}"
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
                   required>
            @error('email')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Password --}}
        <div>
            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password (kosongkan jika tidak diubah)</label>
            <input type="password" name="password" id="password"
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
            @error('password')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Konfirmasi Password --}}
        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation"
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
        </div>

        {{-- Role --}}
        <div>
            <label for="role" class="block text-sm font-medium text-gray-700 mb-1">Role</label>
            <select name="role" id="role"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
                    required>
                @foreach ($roles as $role)
                    <option value="{{ $role->name }}" {{ $user->roles->first()->name == $role->name ? 'selected' : '' }}>
                        {{ ucfirst($role->name) }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Tombol --}}
        <div class="flex justify-between items-center pt-4">
            <a href="{{ route('superadmin.users') }}"
               class="px-5 py-2 rounded-lg bg-gray-200 hover:bg-gray-300 text-gray-700 transition font-medium">
                Batal
            </a>

            <button type="submit"
                    class="px-5 py-2 rounded-lg bg-blue-600 hover:bg-blue-700 text-white font-semibold shadow-sm transition">
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection
