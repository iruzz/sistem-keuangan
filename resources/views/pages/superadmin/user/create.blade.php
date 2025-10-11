@extends('layouts.navbar')

@section('title', 'Tambah User')
@section('page-title', 'Tambah User Baru')

@section('content')
<div class="max-w-xl mx-auto bg-white p-6 rounded-xl shadow-md border border-gray-100">
    <form action="{{ route('superadmin.users.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf

        <div>
            <label class="block text-sm font-semibold text-gray-700">Nama</label>
            <input type="text" name="name" value="{{ old('name') }}"
                class="w-full border border-gray-300 rounded-lg p-2 focus:ring-indigo-500 focus:border-indigo-500"
                required>
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700">Email</label>
            <input type="email" name="email" value="{{ old('email') }}"
                class="w-full border border-gray-300 rounded-lg p-2 focus:ring-indigo-500 focus:border-indigo-500"
                required>
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700">Password</label>
            <input type="password" name="password"
                class="w-full border border-gray-300 rounded-lg p-2 focus:ring-indigo-500 focus:border-indigo-500"
                required>
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700">Konfirmasi Password</label>
            <input type="password" name="password_confirmation"
                class="w-full border border-gray-300 rounded-lg p-2 focus:ring-indigo-500 focus:border-indigo-500"
                required>
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700">Role</label>
            <select name="role" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-indigo-500 focus:border-indigo-500" required>
                <option value="">-- Pilih Role --</option>
                @foreach ($roles as $role)
                    <option value="{{ $role->name }}">{{ ucfirst($role->name) }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700">Foto (Opsional)</label>
            <input type="file" name="foto" accept="image/*"
                class="w-full border border-gray-300 rounded-lg p-2 focus:ring-indigo-500 focus:border-indigo-500">
        </div>

        <div class="flex justify-end gap-3">
            <a href="{{ route('superadmin.users') }}"
               class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300">Batal</a>
            <button type="submit"
               class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Simpan</button>
        </div>
    </form>
</div>
@endsection
