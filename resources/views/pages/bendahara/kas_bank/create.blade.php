@extends('layouts.navbar')

@section('title', 'Tambah Kas/Bank')
@section('page-title', 'Tambah Kas/Bank')

@section('sidebar')
   <li>
      <a href="{{ route('bendahara.dashboard') }}"
         class="flex items-center p-2 text-gray-700 rounded-lg hover:bg-blue-50 hover:text-blue-600 group">
         <i class="fa-solid fa-house w-5 text-gray-500 group-hover:text-blue-600"></i>
         <span class="ms-3 font-medium">Dashboard</span>
      </a>
   </li>

   <li>
      <a href="{{ route('bendahara.akun') }}"
         class="flex items-center p-2 text-gray-700 rounded-lg hover:bg-blue-50 hover:text-blue-600 group">
         <i class="fa-solid fa-wallet w-5 text-gray-500 group-hover:text-blue-600"></i>
         <span class="ms-3 font-medium">Akun Keuangan</span>
      </a>
   </li>

    <li>
      <a href="{{ route('bendahara.kasBank') }}"
         class="flex items-center p-2 text-gray-700 rounded-lg hover:bg-blue-50 hover:text-blue-600 group">
         <i class="fa-solid fa-piggy-bank w-5 text-gray-500 group-hover:text-blue-600"></i>
         <span class="ms-3 font-medium">Kas/Bank</span>
      </a>
   </li>

   <li>
      <a href="{{ route('bendahara.transaksi') }}"
         class="flex items-center p-2 text-gray-700 rounded-lg hover:bg-blue-50 hover:text-blue-600 group">
         <i class="fa-solid fa-receipt w-5 text-gray-500 group-hover:text-blue-600"></i>
         <span class="ms-3 font-medium">Transaksi</span>
      </a>
   </li>

   <li>
      <a href="{{ route('bendahara.detailTs') }}"
         class="flex items-center p-2 text-gray-700 rounded-lg hover:bg-blue-50 hover:text-blue-600 group">
         <i class="fa-solid fa-list w-5 text-gray-500 group-hover:text-blue-600"></i>
         <span class="ms-3 font-medium">Detail Transaksi</span>
      </a>
   </li>


@endsection


@section('content')

<div class="max-w-2xl mx-auto bg-white p-6 rounded-xl shadow-md border border-gray-100">
    <h2 class="text-2xl font-bold mb-6 text-gray-800">Tambah Kas/Bank</h2>

    {{-- Tampilkan error validasi --}}
    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-4">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('bendahara.kasBank.store') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Rekening</label>
            <input type="text" name="nama_rekening" value="{{ old('nama_rekening') }}"
                class="w-full border border-gray-300 rounded-lg p-2.5 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
                placeholder="Contoh: Kas Tunai, Bank BCA, dll"
                required>
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Nomor Rekening</label>
            <input type="text" name="nomor_rekening" value="{{ old('nomor_rekening') }}"
                class="w-full border border-gray-300 rounded-lg p-2.5 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
                placeholder="Contoh: 123456789 (opsional)">
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Tipe</label>
            <select name="tipe" class="w-full border border-gray-300 rounded-lg p-2.5 focus:ring-blue-500 focus:border-blue-500 outline-none transition" required>
                <option value=""> Pilih Tipe </option>
                <option value="Kas" {{ old('tipe') == 'Kas' ? 'selected' : '' }}>Kas</option>
                <option value="Bank" {{ old('tipe') == 'Bank' ? 'selected' : '' }}>Bank</option>
            </select>
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Saldo</label>
            <input type="number" name="saldo" value="{{ old('saldo') }}"
                class="w-full border border-gray-300 rounded-lg p-2.5 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
                placeholder="0"
                min="0">
        </div>

        <div class="flex justify-end gap-3 pt-4">
            <a href="{{ route('bendahara.kasBank') }}"
               class="inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold text-gray-700 bg-gray-200 hover:bg-gray-300 rounded-lg transition">
               <i class="fas fa-times"></i> Batal
            </a>
            <button type="submit"
               class="inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold text-white bg-blue-600 hover:bg-blue-700 rounded-lg transition">
               <i class="fas fa-save"></i> Simpan
            </button>
        </div>
    </form>
</div>

@endsection