@extends('layouts.navbar')

@section('title', 'Manajemen Pengguna')
@section('page-title', 'Daftar Pengguna')

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
<div class="relative overflow-x-auto bg-white shadow-md rounded-xl border border-gray-100">
    {{-- Header --}}
 <div class="flex items-center justify-between flex-wrap gap-4 px-4 py-3 border-b border-gray-100">
    <h2 class="text-lg font-semibold text-gray-800">Daftar User</h2>

    <div class="flex items-center gap-3">
         <div class="flex items-center gap-3">
        {{-- Search --}}
        <form method="GET" action="{{ route('superadmin.users') }}" class="relative">
            <div class="absolute inset-y-0 left-3 flex items-center pointer-events-none">
                <!-- svg -->
            </div>
            <input type="text" name="q" id="table-search-users"
                value="{{ request('q') }}"
                class="block w-72 p-2 pl-9 text-sm text-gray-700 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
                placeholder="Cari pengguna...">
        </form>
        {{-- Tombol Tambah --}}
        <a href="{{ route('superadmin.users.create') }}"
           class="inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold text-white bg-blue-600 hover:bg-blue-700 rounded-lg shadow-sm transition">
            <i class="fas fa-plus"></i> Tambah
        </a>
    </div>
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
                  <div class="w-10 h-10 flex items-center justify-center 
                        bg-gradient-to-br from-indigo-500 via-purple-500 to-pink-500 
                        text-white text-md font-bold rounded-full shadow-lg 
                        backdrop-blur-md ring-2 ring-white/30 transition-transform transform hover:scale-105">
                            {{ strtoupper(substr($user->name, 0, 2)) }}
                  </div>

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
                    <a href="{{ route('superadmin.users.edit', $user->id) }}"
                        class="inline-block text-indigo-600 hover:text-indigo-800 font-medium hover:underline transition">
                        <i class="fas fa-edit"></i> Edit
                    </a>

                     <form action="{{ route('superadmin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Yakin mau hapus {{ $user->name }}?')" class="inline">
    @csrf
    @method('DELETE')
    <button type="submit" class="text-red-600 hover:text-red-800 font-medium hover:underline transition">
        <i class="fas fa-trash"></i> Delete
    </button>
</form>


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
