@extends('layouts.navbar')

@section('title', 'Edit Transaksi')
@section('page-title', 'Edit Transaksi')

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
<div class="max-w-3xl mx-auto bg-white rounded-xl shadow-md p-6 border border-gray-100">
   <h2 class="text-lg font-semibold text-gray-800 mb-6">Edit Data Transaksi</h2>

   <form action="{{ route('bendahara.transaksi.update', $transaksi->id) }}" method="POST">
      @csrf
      @method('PUT')

      {{-- Kode Transaksi --}}
      <div class="mb-4">
         <label for="kode_transaksi" class="block text-sm font-medium text-gray-700 mb-1">Kode Transaksi</label>
         <input type="text" name="kode_transaksi" id="kode_transaksi"
            value="{{ old('kode_transaksi', $transaksi->kode_transaksi) }}"
            class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500">
      </div>

      {{-- Tanggal --}}
      <div class="mb-4">
         <label for="tanggal" class="block text-sm font-medium text-gray-700 mb-1">Tanggal</label>
         <input type="date" name="tanggal" id="tanggal"
            value="{{ old('tanggal', $transaksi->tanggal) }}"
            class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500">
      </div>

      {{-- Deskripsi --}}
      <div class="mb-4">
         <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
         <textarea name="deskripsi" id="deskripsi" rows="3"
            class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500">{{ old('deskripsi', $transaksi->deskripsi) }}</textarea>
      </div>

      {{-- Tipe --}}
      <div class="mb-4">
         <label for="tipe" class="block text-sm font-medium text-gray-700 mb-1">Tipe Transaksi</label>
         <select name="tipe" id="tipe"
            class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500">
            <option value="Pemasukan" {{ old('tipe', $transaksi->tipe) == 'Pemasukan' ? 'selected' : '' }}>Pemasukan</option>
            <option value="Pengeluaran" {{ old('tipe', $transaksi->tipe) == 'Pengeluaran' ? 'selected' : '' }}>Pengeluaran</option>
         </select>
      </div>

      {{-- Total --}}
      <div class="mb-4">
         <label for="total" class="block text-sm font-medium text-gray-700 mb-1">Total (Rp)</label>
         <input type="number" name="total" id="total"
            value="{{ old('total', $transaksi->total) }}"
            class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500">
      </div>

      {{-- Metode Pembayaran --}}
      <div class="mb-6">
         <label for="metode" class="block text-sm font-medium text-gray-700 mb-1">Metode Pembayaran</label>
         <input type="text" name="metode" id="metode"
            value="{{ old('metode', $transaksi->metode) }}"
            class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500">
      </div>

      {{-- Tombol Aksi --}}
      <div class="flex items-center justify-end gap-3">
         <a href="{{ route('bendahara.transaksi') }}"
            class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded-lg transition">
            Batal
         </a>

         <button type="submit"
            class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition">
            Simpan Perubahan
         </button>
      </div>
   </form>
</div>
@endsection
