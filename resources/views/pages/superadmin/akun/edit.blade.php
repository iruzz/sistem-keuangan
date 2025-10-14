@extends('layouts.navbar')

@section('title', 'Edit Akun Keuangan')
@section('page-title', 'Edit Akun Keuangan')

@section('content')
<div class="max-w-2xl mx-auto bg-white shadow-md rounded-xl border border-gray-100 p-6 mt-6">
    <h2 class="text-xl font-semibold text-gray-800 mb-6">Edit Data Akun Keuangan</h2>

    <form action="{{ route('superadmin.akun.update', $akun->id) }}" method="POST" class="space-y-5">
        @csrf
        @method('PUT')

        {{-- Kode Akun --}}
        <div>
            <label for="kode_akun" class="block text-sm font-medium text-gray-700 mb-1">Kode Akun</label>
            <input type="text" name="kode_akun" id="kode_akun"
                   value="{{ old('kode_akun', $akun->kode_akun) }}"
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
                   required>
            @error('kode_akun')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Nama Akun --}}
        <div>
            <label for="nama_akun" class="block text-sm font-medium text-gray-700 mb-1">Nama Akun</label>
            <input type="text" name="nama_akun" id="nama_akun"
                   value="{{ old('nama_akun', $akun->nama_akun) }}"
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
                   required>
            @error('nama_akun')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Jenis Akun --}}
        <div>
            <label for="jenis" class="block text-sm font-medium text-gray-700 mb-2">Jenis Akun</label>
            <select name="jenis" id="jenis" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-indigo-500 focus:border-indigo-500" required>
                <option value="">-- Pilih Jenis Akun --</option>
                @foreach (['Aset', 'Kewajiban', 'Modal', 'Pendapatan', 'Beban'] as $jenis)
                    <option value="{{ $jenis }}" {{ old('jenis', $akun->jenis) == $jenis ? 'selected' : '' }}>
                        {{ $jenis }}
                    </option>
                @endforeach
            </select>
            @error('jenis')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Saldo Awal --}}
        <div>
            <label for="saldo_awal" class="block text-sm font-medium text-gray-700 mb-1">Saldo Awal</label>
            <input type="number" step="0.01" name="saldo_awal" id="saldo_awal"
                   value="{{ old('saldo_awal', $akun->saldo_awal) }}"
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
                   required>
            @error('saldo_awal')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Tombol --}}
        <div class="flex justify-between items-center pt-4">
            <a href="{{ route('superadmin.akun') }}"
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
