@extends('layouts.navbar')

@section('title', 'Tambah User')
@section('page-title', 'Tambah User Baru')
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
<div class="max-w-xl mx-auto bg-white p-6 rounded-xl shadow-md border border-gray-100">

    {{-- ✅ Tampilkan error validasi --}}
    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-3 rounded-lg mb-4">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- ✅ Tampilkan pesan sukses --}}
    @if (session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded-lg mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('superadmin.kategori.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
         <label class="block text-sm font-semibold text-gray-700">Nama Kategori</label>
        <input type="text" name="nama_kategori" value="{{ old('nama_kategori') }}"
    class="w-full border border-gray-300 rounded-lg p-2 focus:ring-indigo-500 focus:border-indigo-500"
    required>

               <div class="mb-4">
    <label for="tipe" class="block text-sm font-medium text-gray-700 mb-2">Jenis Akun</label>
   <select name="tipe" id="tipe"
    class="w-full border border-gray-300 rounded-lg p-2 focus:ring-indigo-500 focus:border-indigo-500"
    required>
    <option value="">-- Pilih Jenis Transaksi --</option>
    <option value="Pemasukan" {{ old('tipe', $kategori->tipe ?? '') == 'Pemasukan' ? 'selected' : '' }}>
        Pemasukan
    </option>
    <option value="Pengeluaran" {{ old('tipe', $kategori->tipe ?? '') == 'Pengeluaran' ? 'selected' : '' }}>
        Pengeluaran
    </option>
</select>

</div>

       


        <div class="flex justify-end gap-3">
            <a href="{{ route('superadmin.akun') }}"
               class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300">Batal</a>
            <button type="submit"
               class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Simpan</button>
        </div>
    </form>
</div>
@endsection
