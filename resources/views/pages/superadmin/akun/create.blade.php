@extends('layouts.navbar')

@section('title', 'Tambah User')
@section('page-title', 'Tambah User Baru')

@section('sidebar')
         <li>
               <a href="{{ route('superadmin.dashboard')}}"
                  class="flex items-center p-2 text-gray-700 rounded-lg hover:bg-blue-50 hover:text-blue-600 group">
                  <i class="fa-solid fa-house w-5 text-gray-500 group-hover:text-blue-600"></i>
                  <span class="ms-3 font-medium">Dashboard</span>
               </a>
            </li>
               <a href="{{ route('superadmin.users')}}"
                  class="flex items-center p-2 text-gray-700 rounded-lg hover:bg-blue-50 hover:text-blue-600 group">
                  <i class="fa-solid fa-user w-5 text-gray-500 group-hover:text-blue-600"></i>
                  <span class="ms-3 font-medium">Users</span>
               </a>
            </li>
              </li>
               <a href="{{ route('superadmin.akun')}}"
                  class="flex items-center p-2 text-gray-700 rounded-lg hover:bg-blue-50 hover:text-blue-600 group">
                  <i class="fa-solid fa-user w-5 text-gray-500 group-hover:text-blue-600"></i>
                  <span class="ms-3 font-medium">Akun Keuangan</span>
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

    <form action="{{ route('superadmin.akun.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        <input type="text" name="kode_akun" value="{{ old('kode_akun') }}"
    class="w-full border border-gray-300 rounded-lg p-2 focus:ring-indigo-500 focus:border-indigo-500"
    required>


        <div>
            <label class="block text-sm font-semibold text-gray-700">Nama Akun</label>
            <input type="text" name="nama_akun" value="{{ old('nama_akun') }}"
                class="w-full border border-gray-300 rounded-lg p-2 focus:ring-indigo-500 focus:border-indigo-500"
                required>
        </div>
        
               <div class="mb-4">
    <label for="jenis" class="block text-sm font-medium text-gray-700 mb-2">Jenis Akun</label>
    <select name="jenis" id="jenis" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-indigo-500 focus:border-indigo-500" required>
        <option value="">-- Pilih Jenis Akun --</option>
        <option value="Aset" {{ old('jenis', $akun->jenis ?? '') == 'Aset' ? 'selected' : '' }}>Aset</option>
        <option value="Kewajiban" {{ old('jenis', $akun->jenis ?? '') == 'Kewajiban' ? 'selected' : '' }}>Kewajiban</option>
        <option value="Modal" {{ old('jenis', $akun->jenis ?? '') == 'Modal' ? 'selected' : '' }}>Modal</option>
        <option value="Pendapatan" {{ old('jenis', $akun->jenis ?? '') == 'Pendapatan' ? 'selected' : '' }}>Pendapatan</option>
        <option value="Beban" {{ old('jenis', $akun->jenis ?? '') == 'Beban' ? 'selected' : '' }}>Beban</option>
    </select>
</div>

        <div>
            <label class="block text-sm font-semibold text-gray-700">Saldo Awal</label>
            <input type="number" name="saldo_awal" value="{{ old('saldo_awal') }}"
                class="w-full border border-gray-300 rounded-lg p-2 focus:ring-indigo-500 focus:border-indigo-500"
                required>
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
