@extends('layouts.navbar')

@section('title', 'Manajemen Pengguna')
@section('page-title', 'Daftar Pengguna')

@section('content')
<div class="relative overflow-x-auto bg-white shadow-md rounded-xl border border-gray-100">
    {{-- Header --}}
 <div class="flex items-center justify-between flex-wrap gap-4 px-4 py-3 border-b border-gray-100">
    <h2 class="text-lg font-semibold text-gray-800">Daftar User</h2>

    <div class="flex items-center gap-3">
        {{-- Search --}}
        <div class="relative">
            <div class="absolute inset-y-0 left-3 flex items-center pointer-events-none">
                <svg class="w-4 h-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                </svg>
            </div>
            <input type="text" id="table-search-users"
                class="block w-72 p-2 pl-9 text-sm text-gray-700 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
                placeholder="Cari pengguna...">
        </div>

        {{-- Tombol Tambah --}}
        <a href="{{ route('superadmin.users.create') }}"
           class="inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold text-white bg-blue-600 hover:bg-blue-700 rounded-lg shadow-sm transition">
            <i class="fas fa-plus"></i> Tambah
        </a>
    </div>
</div>


    {{-- Tabel --}}
    <table class="w-full text-sm text-left text-gray-600">
        <thead class="text-xs text-gray-500 uppercase bg-gray-50 border-b border-gray-100">
            <tr>
                <th class="px-6 py-3 font-semibold">Name</th>
                <th class="px-6 py-3 font-semibold">Email</th>
                <th class="px-6 py-3 font-semibold">Role</th>
                <th class="px-6 py-3 font-semibold text-center">Action</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($data as $user)
            <tr class="bg-white border-b border-gray-100 hover:bg-gray-50 transition">
                {{-- Nama dan Email --}}
                <th scope="row" class="flex items-center px-6 py-4 whitespace-nowrap">
                <img class="w-10 h-10 rounded-full"
     src="{{ asset('storage/foto_user/' . $user->nama_file_foto) }}"
     alt="Profile image">



                    <div class="pl-3">
                        <div class="text-base font-semibold text-gray-800">{{ $user->name }}</div>
                        <div class="text-gray-500 text-sm">{{ $user->email }}</div>
                    </div>
                </th>

                {{-- Role --}}
                <td class="px-6 py-4">{{ $user->email }}</td>
                <td class="px-6 py-4">{{ $user->getRoleNames()->join(', ') ?: '-' }}</td>

                {{-- Action --}}
                <td class="px-6 py-4 text-center space-x-3">
                    <a href="#"
                        class="inline-block text-indigo-600 hover:text-indigo-800 font-medium hover:underline transition">
                        <i class="fas fa-edit"></i> Edit
                    </a>

                    <button onclick="confirmDelete('{{ $user->id }}')"
                        class="text-red-600 hover:text-red-800 font-medium hover:underline transition">
                        <i class="fas fa-trash"></i> Delete
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

{{-- Script konfirmasi hapus --}}
<script>
    function confirmDelete(id) {
        if (confirm('Yakin ingin menghapus akun dengan ID ' + id + '?')) {
            alert('Fitur delete belum diaktifkan untuk ID ' + id);
        }
    }
</script>
@endsection
