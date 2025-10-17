@extends('layouts.navbar')

@section('title', 'Kategori Transaksi')
@section('page-title', 'Edit Kategori')

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
    <h2 class="text-xl font-semibold text-gray-800 mb-6">Edit Kategori Transaksi</h2>

    <form action="{{ route('superadmin.kategori.update', $kategori->id) }}" method="POST" class="space-y-5">
        @csrf
        @method('PUT')



        {{-- Nama Akun --}}
        <div>
            <label for="nama_kategori" class="block text-sm font-medium text-gray-700 mb-1">Nama Kategori</label>
            <input type="text" name="nama_kategori" id="nama_kategori"
                   value="{{ old('nama_kategori', $kategori->nama_kategori) }}"
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
                   required>
            @error('nama_kategori')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Jenis Akun --}}
        <div>
            <label for="tipe" class="block text-sm font-medium text-gray-700 mb-2">Jenis Kategori</label>
            <select name="tipe" id="tipe" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-indigo-500 focus:border-indigo-500" required>
                <option value="">-- Pilih Tipe Transaksi --</option>
                @foreach (['Pemasukan', 'Pengeluaran'] as $tipe)
                    <option value="{{ $tipe }}" {{ old('tipe', $kategori->tipe) == $tipe ? 'selected' : '' }}>
                        {{ $tipe }}
                    </option>
                @endforeach
            </select>
            @error('tipe')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>


        {{-- Tombol --}}
        <div class="flex justify-between items-center pt-4">
            <a href="{{ route('superadmin.kategori') }}"
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
